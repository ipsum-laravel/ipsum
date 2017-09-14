<?php

class ArticleTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create('fr_FR');

        $datas_for_all = array(
            'categorie_id' => '1',
            'extrait' => 'Lorem ipsum Altera sententia est, squae definit.',
            'texte' => '',
            'texte_md' => '',
        );
        foreach ($this->getDatas() as $data) {
            $data = $data + $datas_for_all;
            $article = \App\Article\Article::create($data);
            $article->slug = $data['slug'];
            $article->save();
        }

        foreach ($this->getCategories() as $data) {
            \App\Article\Categorie::create($data);
        }


        for ($i=0; $i < 3; $i++) {
            $titre = $faker->sentence(6);
            $texte = $faker->text;
            
            $article = new \App\Article\Article;
            
            $article->titre = $titre;
            $article->extrait = Str::limit($texte);
            $article->texte_md = $texte;

            $article->categorie_id = \App\Article\Categorie::ACTUALITE_ID;
            $article->save();
        }
    }

    private function getDatas()
    {
        return array(
            array(
                'slug' => '',
                'titre' => 'Accueil',
            ),
        );
    }

    private function getCategories()
    {
        return array(
            array(
                'id' => \App\Article\Categorie::PAGE_ID,
                'nom' => 'Page',
            ),
            array(
                'id' => \App\Article\Categorie::ACTUALITE_ID,
                'nom' => 'Actualités',
            ),
        );
    }
}
