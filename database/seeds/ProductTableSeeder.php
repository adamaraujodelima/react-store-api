<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
            'nome' => 'Iphone 8 Plus',
            'descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec at nulla purus. Vestibulum mauris enim, porta eu facilisis at, vulputate ut tellus. In feugiat leo quis augue egestas cursus. Aenean eget massa risus. Donec nisl urna, pellentesque eget magna sed, sagittis pulvinar tellus. Nullam non leo in nulla laoreet consequat in a massa. In gravida lectus interdum, faucibus nibh non, fringilla neque. Ut eget ullamcorper ex.',
            'preco' => floatval(round(5)),
            'imagem' => 'products/iphone8plus.jpg'
        ]);

        DB::table('product')->insert([
            'nome' => 'Iphone 7 Plus',
            'descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec at nulla purus. Vestibulum mauris enim, porta eu facilisis at, vulputate ut tellus. In feugiat leo quis augue egestas cursus. Aenean eget massa risus. Donec nisl urna, pellentesque eget magna sed, sagittis pulvinar tellus. Nullam non leo in nulla laoreet consequat in a massa. In gravida lectus interdum, faucibus nibh non, fringilla neque. Ut eget ullamcorper ex.',
            'preco' => floatval(round(5)),
            'imagem' => 'products/iphone7plus.jpg'
        ]);

        DB::table('product')->insert([
            'nome' => 'Iphone 6 S',
            'descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec at nulla purus. Vestibulum mauris enim, porta eu facilisis at, vulputate ut tellus. In feugiat leo quis augue egestas cursus. Aenean eget massa risus. Donec nisl urna, pellentesque eget magna sed, sagittis pulvinar tellus. Nullam non leo in nulla laoreet consequat in a massa. In gravida lectus interdum, faucibus nibh non, fringilla neque. Ut eget ullamcorper ex.',
            'preco' => floatval(round(5)),
            'imagem' => 'products/iphone6s.jpg'
        ]);
        
        DB::table('product')->insert([
            'nome' => 'Iphone 5 S',
            'descricao' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec at nulla purus. Vestibulum mauris enim, porta eu facilisis at, vulputate ut tellus. In feugiat leo quis augue egestas cursus. Aenean eget massa risus. Donec nisl urna, pellentesque eget magna sed, sagittis pulvinar tellus. Nullam non leo in nulla laoreet consequat in a massa. In gravida lectus interdum, faucibus nibh non, fringilla neque. Ut eget ullamcorper ex.',
            'preco' => floatval(round(5)),
            'imagem' => 'products/iphone5s.jpg'
        ]);
    }
}
