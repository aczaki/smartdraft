<?php

namespace App\Services;

use App\Models\Template;
use Illuminate\Support\Str;

class TemplateSelector
{
    /**
     * Mengembalikan path absolute ke file DOCX (public path).
     * Jika tidak ada, lempar exception atau kembalikan null tergantung kebutuhan.
     */
    public function getTemplateByText(string $text): ?string
    {
        $textLower = strtolower($text ?? '');

        $templates = Template::all();

        foreach ($templates as $template) {
            $keywords = array_filter(array_map('trim', explode(',', $template->keyword ?? '')));

            foreach ($keywords as $keyword) {
                if ($keyword === '') continue;
                if (Str::contains($textLower, strtolower($keyword))) {
                    $full = public_path($template->path_file);
                    if (file_exists($full)) {
                        return $full;
                    }
                }
            }
        }

        // fallback ke jenis 'default'
        $default = Template::where('jenis_surat', 'default')->first();
        if ($default && file_exists(public_path($default->path_file))) {
            return public_path($default->path_file);
        }

        // Tidak ditemukan: kembalikan null
        return null;
    }
}
