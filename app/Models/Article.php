<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use DOMDocument;
use DOMXPath;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'img_banner', 'type', 'text', 'slug','description'];

    // Relation avec Media
    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
        });

        static::updating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
        });
    }

    /**
     * ✅ Méthode pour importer un article depuis un lien LinkedIn
     * @param string $url
     * @return Article|null
     */
    public static function importFromLinkedin(string $url): ?Article
    {
        $data = self::fetchLinkedinMetadata($url);

        if (!$data['title']) {
            return null; // Impossible d'extraire l'article
        }

        return self::create([
            'title' => $data['title'],
            'description' => !empty($data['description']) ? $data['description'] : 'Description non disponible',
            'text' => !empty($data['content']) ? $data['content'] : 'Contenu non disponible', // ✅ Ajout du contenu réel
            'img_banner' => $data['image'] ?? null,
            'slug' => Str::slug($data['title']),
            'type' => 'article linkedin',
        ]);
    }


    /**
     * ✅ Récupère les métadonnées OpenGraph d'un article LinkedIn
     * @param string $url
     * @return array
     */
    private static function fetchLinkedinMetadata(string $url): array
    {
        $html = @file_get_contents($url);
        if (!$html) {
            return ['title' => '', 'image' => '', 'description' => '', 'content' => ''];
        }
    
        libxml_use_internal_errors(true);
        $doc = new DOMDocument();
        $doc->loadHTML($html);
        $xpath = new DOMXPath($doc);
    
        $data = [
            'title' => '',
            'image' => '',
            'description' => '',
            'content' => ''
        ];
    
        // Récupérer les balises meta Open Graph
        foreach (['title', 'image', 'description'] as $property) {
            $node = $xpath->query("//meta[@property='og:{$property}']");
            if ($node->length > 0) {
                $data[$property] = $node->item(0)->getAttribute('content');
            }
        }
    
        // 🛠️ Récupération du contenu via JSON-LD
        $scriptNodes = $xpath->query("//script[@type='application/ld+json']");
        foreach ($scriptNodes as $script) {
            $json = json_decode($script->nodeValue, true);
            if (isset($json['articleBody'])) {
                $data['content'] = $json['articleBody'];
                break;
            }
        }
    
        return $data;
    }
    


}