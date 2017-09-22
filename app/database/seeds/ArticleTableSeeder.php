<?php

class ArticleTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create('fr_FR');

        $datas_for_all = array(
            'type' => \App\Article\Article::PAGE_ID,
            'extrait' => 'Lorem ipsum Altera sententia est, squae definit.',
            'texte' => '',
            'texte_md' => '',
        );

        // Sedd pages
        foreach ($this->getDatas() as $data) {
            $data = $data + $datas_for_all;
            $article = \App\Article\Article::create($data);
            $article->slug = $data['slug'];
            $article->categorie_id = rand(1, 2);
            $article->save();
        }

        // Seed Actualités
        for ($i=0; $i < 3; $i++) {
            $titre = $faker->sentence(6);
            $texte = $faker->text;
            
            $article = new \App\Article\Article;
            
            $article->titre = $titre;
            $article->extrait = Str::limit($texte);
            $article->texte_md = $texte;

            $article->type = \App\Article\Article::ACTUALITE_ID;
            $article->save();
        }

        // Seed catégories
        foreach ($this->getCategories() as $data) {
            \App\Article\Categorie::create($data);
        }
    }

    private function getDatas()
    {
        return array(
            array(
                'slug' => '',
                'titre' => 'Accueil',
            ),
            array(
                'slug' => 'page1',
                'titre' => 'Page 1',
            ),
            array(
                'slug' => 'page2',
                'titre' => 'Page 2',
            ),
            array(
                'slug' => 'contact',
                'titre' => 'Contact',
            ),
            array(
                'slug' => 'mentions-legales',
                'titre' => 'Mentions légales',
            ),
        );
    }

    private function getCategories()
    {
        return array(
            array(
                'nom' => 'Catégorie 1',
            ),
            array(
                'nom' => 'Catégorie 2',
            ),
        );
    }
}
