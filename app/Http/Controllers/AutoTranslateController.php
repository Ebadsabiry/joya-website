<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AutoTranslateController extends Controller
{
    public function translate(Request $request)
    {
        // Accept either { text: "..." } or { texts: ["...","..."] }
        $payload = $request->all();
        $target = $request->input('target');

        if (!$target) {
            return response()->json(['error' => 'target required'], 400);
        }

        $items = [];
        if (isset($payload['texts']) && is_array($payload['texts'])) {
            $items = $payload['texts'];
        } elseif (isset($payload['text']) && is_string($payload['text'])) {
            $items = [$payload['text']];
        } else {
            return response()->json(['error' => 'text or texts required'], 400);
        }

        $results = [];
        foreach ($items as $item) {
            $itemKey = 'auto_translate_' . md5($item . '_' . $target);
            if (Cache::has($itemKey)) {
                $results[] = Cache::get($itemKey);
                continue;
            }

            try {
                $res = Http::timeout(12)->post('https://libretranslate.com/translate', [
                    'q'      => $item,
                    'source' => 'en',
                    'target' => $target,
                    'format' => 'text',
                ]);

                if (!$res->ok()) {
                    Log::warning('Translate API non-ok', ['status' => $res->status(), 'body' => $res->body()]);
                    // fallback: push original string (avoids breaking positions)
                    $results[] = $item;
                    continue;
                }

                $json = $res->json();
                $translated = $json['translatedText'] ?? ($json['translated'] ?? null);

                if (!$translated) {
                    Log::warning('Translate API returned no translated text', ['body' => $json]);
                    $results[] = $item;
                    continue;
                }

                Cache::put($itemKey, $translated);
                $results[] = $translated;
            } catch (\Exception $e) {
                Log::error('AutoTranslateController exception', ['msg' => $e->getMessage()]);
                $results[] = $item;
            }
        }

        // Return in the same order
        return response()->json(['translations' => $results]);
    }
}
