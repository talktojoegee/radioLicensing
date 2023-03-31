<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $docs = [
            [
                'name'=>'Word Document',
                'extension'=>'doc'
            ],[
                'name'=>'Word Document X',
                'extension'=>'docx'
            ],[
                'name'=>'Power Point',
                'extension'=>'ppt'
            ],[
                'name'=>'Portable Document Format',
                'extension'=>'pdf'
            ],
            [
                'name'=>'Portable Network Graphics',
                'extension'=>'png'
            ],
            [
                'name'=>'Joint Photographic Experts Group',
                'extension'=>'jpeg'
            ],
            [
                'name'=>'Joint Photographic Group ',
                'extension'=>'jpg'
            ]
        ];
        foreach ($docs as $doc){
            DocumentType::create($doc);
        }
    }
}
