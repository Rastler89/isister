<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Breed;
use App\Models\Specie;

class SpecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cat = Specie::create([
            'name' => '{"es": "Gato", "en": "Cat"}'
        ]);

        $dog = Specie::create([
            'name' => '{"es": "Perro", "en": "Dog"}'
        ]);

        $cats = array(
        [
            'name' => json_encode(['es' => 'Siamés', 'en' => 'Siames']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Persa', 'en' => 'Persa']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Kohana', 'en' => 'Kohana']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Británico de pelo corto', 'en' => 'British shorthair']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Elfo', 'en' => 'Elfo']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Bambino', 'en' => 'Bambino']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Levkoy ucraniano', 'en' => 'Levkoy ucraniano']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Lykoi (gato lobo)', 'en' => 'Lykoi']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Americano de pelo corto', 'en' => 'American shorthair']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Bengalí', 'en' => 'Bengali']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Himalayo', 'en' => 'Himalayo']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Manx', 'en' => 'Manx']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Nebelung', 'en' => 'Nebelung']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Maine Coon', 'en' => 'Maine Coon']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Ceilán', 'en' => 'Ceilán']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Kurilian Bobtail', 'en' => 'Kurilian Bobtail']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Ragdoll', 'en' => 'Ragdoll']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Thai (Siamés original)', 'en' => 'Thai']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Rex Alemán', 'en' => 'German Rex']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Don Sphynx / Donskoy', 'en' => 'Don Sphynx / Donskoy']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Neva Masquerade', 'en' => 'Neva Masquerade']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Van Turco', 'en' => 'Van Turco']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Snowshoe', 'en' => 'Snowshoe']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Chantilly-Tiffany', 'en' => 'Chantilly-Tiffany']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Colorpoint', 'en' => 'Colorpoint']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Angora Turco', 'en' => 'Angora Turco']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Minskin', 'en' => 'Minskin']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Habana', 'en' => 'Habana']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Común Europeo (Romano)', 'en' => 'European']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Ragamuffin', 'en' => 'Ragamuffin']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Ashera', 'en' => 'Ashera']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Británico de Pelo Largo', 'en' => 'British Longhair']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Khao Manee', 'en' => 'Khao Manee']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Caracat', 'en' => 'Caracat']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Highland Fold', 'en' => 'Highland Fold']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Bobtail Americano', 'en' => 'American Bobtail']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Cymric', 'en' => 'Cymric']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Skookum', 'en' => 'Skookum']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Toyger', 'en' => 'Toyger']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Munchkin', 'en' => 'Munchkin']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'American Wirehair', 'en' => 'American Wirehair']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Pixie Bob', 'en' => 'Pixie Bob']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Tonkinés', 'en' => 'Tonkinés']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'LaPerm', 'en' => 'LaPerm']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Burmilla', 'en' => 'Burmilla']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Curl Americano', 'en' => 'Curl Americano']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Montés', 'en' => 'Montés']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Chausie', 'en' => 'Chausie']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Devon Rex', 'en' => 'Devon Rex']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Javanés (Oriental de Pelo Largo)', 'en' => 'Javanés (Oriental de Pelo Largo)']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Scottish Fold', 'en' => 'Scottish Fold']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Korat', 'en' => 'Korat']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Somali', 'en' => 'Somali']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Sphynx / Esfinge', 'en' => 'Sphynx / Esfinge']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Savannah', 'en' => 'Savannah']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Chartreux', 'en' => 'Chartreux']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Sokoke', 'en' => 'Sokoke']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Selkirk Rex', 'en' => 'Selkirk Rex']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Cornish Rex', 'en' => 'Cornish Rex']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Ocicat', 'en' => 'Ocicat']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Peterbald', 'en' => 'Peterbald']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Oriental de Pelo Corto', 'en' => 'Oriental de Pelo Corto']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Siberiano', 'en' => 'Siberiano']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Exótico de Pelo Corto', 'en' => 'Exótico de Pelo Corto']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Birmano', 'en' => 'Birmano']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Bosque de Noruega', 'en' => 'Bosque de Noruega']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Abyssinian', 'en' => 'Abyssinian']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Balinés', 'en' => 'Balinés']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Russian Blue', 'en' => 'Azul Ruso']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Bombay', 'en' => 'Bombay']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Egyptian Mau', 'en' => 'Mau Egipcio']),
            'specie_id' => $cat->id
        ],
        [
            'name' => json_encode(['es' => 'Australian Mist', 'en' => 'Australian Mist']),
            'specie_id' => $cat->id
        ]);

        foreach ($cats as $race) {
            Breed::create($race);
        }

        $dogs = array(
        [
                'name_es' => 'pastor belga tervueren',
                'name_en' => 'pastor belga tervueren',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'bobtail',
                'name_en' => 'bobtail',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'fox terrier de pelo duro',
                'name_en' => 'fox terrier de pelo duro',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'whippet',
                'name_en' => 'whippet',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'braco alemán de pelo corto',
                'name_en' => 'braco alemán de pelo corto',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pinscher miniatura',
                'name_en' => 'pinscher miniatura',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'bichón maltés',
                'name_en' => 'bichón maltés',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'manchester terrier',
                'name_en' => 'manchester terrier',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'terrier tibetano',
                'name_en' => 'terrier tibetano',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'lancashire heeler',
                'name_en' => 'lancashire heeler',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'lobero irlandés',
                'name_en' => 'lobero irlandés',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'agua irlandés',
                'name_en' => 'agua irlandés',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'alaskan malamute',
                'name_en' => 'alaskan malamute',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pastor australiano de cola corta',
                'name_en' => 'pastor australiano de cola corta',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'otterhound',
                'name_en' => 'otterhound',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pila argentino',
                'name_en' => 'pila argentino',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'shepadoodle',
                'name_en' => 'shepadoodle',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'sueco de laponia',
                'name_en' => 'sueco de laponia',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'tossa inu',
                'name_en' => 'tossa inu',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'basenji',
                'name_en' => 'basenji',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pastor ovejero australiano',
                'name_en' => 'pastor ovejero australiano',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'alabai',
                'name_en' => 'alabai',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'schapendoes neerlandés',
                'name_en' => 'schapendoes neerlandés',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'schnauzer miniatura',
                'name_en' => 'schnauzer miniatura',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'cavalier king charles spaniel',
                'name_en' => 'cavalier king charles spaniel',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'cocker spaniel inglés',
                'name_en' => 'cocker spaniel inglés',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'beagle',
                'name_en' => 'beagle',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'mudi',
                'name_en' => 'mudi',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pumi',
                'name_en' => 'pumi',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'northern inuit',
                'name_en' => 'northern inuit',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pastor islandés',
                'name_en' => 'pastor islandés',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'bardino o majorero',
                'name_en' => 'bardino o majorero',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'lobo herreño',
                'name_en' => 'lobo herreño',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'black mouth cur',
                'name_en' => 'black mouth cur',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'podenco faraónico',
                'name_en' => 'podenco faraónico',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'tamaskan',
                'name_en' => 'tamaskan',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'mini aussie (pastor americano o australiano miniatura)',
                'name_en' => 'mini aussie (pastor americano o australiano miniatura)',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'clumber spaniel',
                'name_en' => 'clumber spaniel',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'shih tzu',
                'name_en' => 'shih tzu',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'shiba inu',
                'name_en' => 'shiba inu',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'peruano',
                'name_en' => 'peruano',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'dóberman pinscher',
                'name_en' => 'dóberman pinscher',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'basset hound',
                'name_en' => 'basset hound',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'agua portugués',
                'name_en' => 'agua portugués',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'bichón frisé',
                'name_en' => 'bichón frisé',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'gordon setter',
                'name_en' => 'gordon setter',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pomsky',
                'name_en' => 'pomsky',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'alusky',
                'name_en' => 'alusky',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'collie smooth',
                'name_en' => 'collie smooth',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'yorkshire blanco',
                'name_en' => 'yorkshire blanco',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pinscher austriaco',
                'name_en' => 'pinscher austriaco',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'mastín español',
                'name_en' => 'mastín español',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'podenco orito español',
                'name_en' => 'podenco orito español',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'braco de weimar',
                'name_en' => 'braco de weimar',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'alano español',
                'name_en' => 'alano español',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'dandie dinmont terrier',
                'name_en' => 'dandie dinmont terrier',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'chow chow',
                'name_en' => 'chow chow',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'border collie',
                'name_en' => 'border collie',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'spaniel bretón',
                'name_en' => 'spaniel bretón',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'keeshond',
                'name_en' => 'keeshond',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'shikoku inu',
                'name_en' => 'shikoku inu',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'deutscher boxer',
                'name_en' => 'deutscher boxer',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'podenco ibicenco',
                'name_en' => 'podenco ibicenco',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'appenzeller',
                'name_en' => 'appenzeller',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pointer inglés',
                'name_en' => 'pointer inglés',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'fila brasileño',
                'name_en' => 'fila brasileño',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'landseer',
                'name_en' => 'landseer',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'podenco andaluz maneto',
                'name_en' => 'podenco andaluz maneto',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'cockapoo',
                'name_en' => 'cockapoo',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'bloodhound',
                'name_en' => 'bloodhound',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'podenco canario',
                'name_en' => 'podenco canario',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pastor belga laekenois',
                'name_en' => 'pastor belga laekenois',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'bearded collie',
                'name_en' => 'bearded collie',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'welsh corgi pembroke',
                'name_en' => 'welsh corgi pembroke',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'terrier australiano',
                'name_en' => 'terrier australiano',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'american staffordshire terrier',
                'name_en' => 'american staffordshire terrier',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pastor croata',
                'name_en' => 'pastor croata',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'dogo mallorquín',
                'name_en' => 'dogo mallorquín',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'harrier',
                'name_en' => 'harrier',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'setter irlandés rojo y blanco',
                'name_en' => 'setter irlandés rojo y blanco',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'biewer yorkshire terrier',
                'name_en' => 'biewer yorkshire terrier',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'affenpinscher',
                'name_en' => 'affenpinscher',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'setter inglés',
                'name_en' => 'setter inglés',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'akita inu',
                'name_en' => 'akita inu',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'dachslund o teckel estándar',
                'name_en' => 'dachslund o teckel estándar',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'setter irlandés',
                'name_en' => 'setter irlandés',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'deerhound (lebrel escocés)',
                'name_en' => 'deerhound (lebrel escocés)',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pastor del sur de rusia',
                'name_en' => 'pastor del sur de rusia',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'lakeland terrier',
                'name_en' => 'lakeland terrier',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'poodle mediano',
                'name_en' => 'poodle mediano',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'poodle toy',
                'name_en' => 'poodle toy',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'mastiff (mastín inglés)',
                'name_en' => 'mastiff (mastín inglés)',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'labrador retriever',
                'name_en' => 'labrador retriever',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pastor de brie',
                'name_en' => 'pastor de brie',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'groenlandia',
                'name_en' => 'groenlandia',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'akita americano',
                'name_en' => 'akita americano',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pit bull terrier americano',
                'name_en' => 'pit bull terrier americano',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'terrier americano sin pelo',
                'name_en' => 'terrier americano sin pelo',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'chindo',
                'name_en' => 'chindo',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pastor de shetland',
                'name_en' => 'pastor de shetland',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'soft coated wheaten terrier irlandés',
                'name_en' => 'soft coated wheaten terrier irlandés',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pastor alemán',
                'name_en' => 'pastor alemán',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'galgo español',
                'name_en' => 'galgo español',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'mastín del pirineo',
                'name_en' => 'mastín del pirineo',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'shar pei',
                'name_en' => 'shar pei',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'yorkshire terrier',
                'name_en' => 'yorkshire terrier',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'spitz de norrbotten',
                'name_en' => 'spitz de norrbotten',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'bull arab',
                'name_en' => 'bull arab',
                'specie_id' => $dog->id
        ], [
                'name_es' => 'boykin spaniel',
                'name_en' => 'boykin spaniel',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'poodle enano',
                'name_en' => 'poodle enano',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'spaniel tibetano',
                'name_en' => 'spaniel tibetano',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'vallhund sueco',
                'name_en' => 'vallhund sueco',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'komondor',
                'name_en' => 'komondor',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'american english coonhound',
                'name_en' => 'american english coonhound',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'poochon',
                'name_en' => 'poochon',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'labsky o huskador',
                'name_en' => 'labsky o huskador',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'cuvac eslovaco',
                'name_en' => 'cuvac eslovaco',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'shepsky',
                'name_en' => 'shepsky',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'poodle estándar',
                'name_en' => 'poodle estándar',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pastor leonés',
                'name_en' => 'pastor leonés',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'barbet o agua francés',
                'name_en' => 'barbet o agua francés',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'dogo canario o presa canario',
                'name_en' => 'dogo canario o presa canario',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'calupoh (lobo mexicano)',
                'name_en' => 'calupoh (lobo mexicano)',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'springel spaniel inglés',
                'name_en' => 'springel spaniel inglés',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'carlino (pug)',
                'name_en' => 'carlino (pug)',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'rottweiler',
                'name_en' => 'rottweiler',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'huskye siberiano',
                'name_en' => 'huskye siberiano',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'jack rusell terrier',
                'name_en' => 'jack rusell terrier',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'bernedoodle',
                'name_en' => 'bernedoodle',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pastor belga malinois',
                'name_en' => 'pastor belga malinois',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'leopardo de catahoula',
                'name_en' => 'leopardo de catahoula',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'kerry blue terrier',
                'name_en' => 'kerry blue terrier',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pastor de los cárpatos',
                'name_en' => 'pastor de los cárpatos',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'chihuahua',
                'name_en' => 'chihuahua',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'mucuchíes',
                'name_en' => 'mucuchíes',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pachón navarro',
                'name_en' => 'pachón navarro',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'zuchón o sichón',
                'name_en' => 'zuchón o sichón',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'chodksy',
                'name_en' => 'chodksy',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'golden retriever',
                'name_en' => 'golden retriever',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'kishu inu',
                'name_en' => 'kishu inu',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'cimarrón uruguayo',
                'name_en' => 'cimarrón uruguayo',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'american bully',
                'name_en' => 'american bully',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'shorkie',
                'name_en' => 'shorkie',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pinscher alemán',
                'name_en' => 'pinscher alemán',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'frenchton',
                'name_en' => 'frenchton',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'goldador o golden lab',
                'name_en' => 'goldador o golden lab',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'teddy roosevelt terrier',
                'name_en' => 'teddy roosevelt terrier',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'husky inu',
                'name_en' => 'husky inu',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'aïdi o montañas del atlas',
                'name_en' => 'aïdi o montañas del atlas',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'mal-shi',
                'name_en' => 'mal-shi',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'schnocker',
                'name_en' => 'schnocker',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'shih-poo',
                'name_en' => 'shih-poo',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'braco francés (Gascuña/Pirineos)',
                'name_en' => 'braco francés (Gascuña/Pirineos)',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'bullhuahua',
                'name_en' => 'bullhuahua',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'aussiedoodle o aussiepoo',
                'name_en' => 'aussiedoodle o aussiepoo',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'azawakh',
                'name_en' => 'azawakh',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'cavapoo o cavoodle',
                'name_en' => 'cavapoo o cavoodle',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'puggle',
                'name_en' => 'puggle',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'schnoodle',
                'name_en' => 'schnoodle',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'cavachón',
                'name_en' => 'cavachón',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'yorkie poo',
                'name_en' => 'yorkie poo',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'chorkie',
                'name_en' => 'chorkie',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'morkie',
                'name_en' => 'morkie',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'australian cobberdog',
                'name_en' => 'australian cobberdog',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'kelpie australiano',
                'name_en' => 'kelpie australiano',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'goldendoodle',
                'name_en' => 'goldendoodle',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'maltipoo',
                'name_en' => 'maltipoo',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'labradoodle',
                'name_en' => 'labradoodle',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'podenco portugués',
                'name_en' => 'podenco portugués',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'eurasier',
                'name_en' => 'eurasier',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pastor caucásico',
                'name_en' => 'pastor caucásico',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'thai ridgeback',
                'name_en' => 'thai ridgeback',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'berger de picardie',
                'name_en' => 'berger de picardie',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'spitz finlandés (suomenpystykorva)',
                'name_en' => 'spitz finlandés (suomenpystykorva)',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'elkhound',
                'name_en' => 'elkhound',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'foxhound americano',
                'name_en' => 'foxhound americano',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'foxhound inglés',
                'name_en' => 'foxhound inglés',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'sloughi o lebrel árabe',
                'name_en' => 'sloughi o lebrel árabe',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'braco italiano',
                'name_en' => 'braco italiano',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'palleiro',
                'name_en' => 'palleiro',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'kuvasz',
                'name_en' => 'kuvasz',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pastor holandés',
                'name_en' => 'pastor holandés',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'bedlington terrier',
                'name_en' => 'bedlington terrier',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'borzoi',
                'name_en' => 'borzoi',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'lobo checoslovaco',
                'name_en' => 'lobo checoslovaco',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'xoloitzuintle',
                'name_en' => 'xoloitzuintle',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'ratonero valenciano',
                'name_en' => 'ratonero valenciano',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'parson russell terrier',
                'name_en' => 'parson russell terrier',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'cocker spaniel americano',
                'name_en' => 'cocker spaniel americano',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'galgo italiano',
                'name_en' => 'galgo italiano',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'bodeguero andaluz',
                'name_en' => 'bodeguero andaluz',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'bull terrier inglés miniatura',
                'name_en' => 'bull terrier inglés miniatura',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'bichón habanero',
                'name_en' => 'bichón habanero',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'bichón boloñés',
                'name_en' => 'bichón boloñés',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'grifón belga',
                'name_en' => 'grifón belga',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'petit brabançon',
                'name_en' => 'petit brabançon',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'grifón de bruselas',
                'name_en' => 'grifón de bruselas',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'west highland white terrier',
                'name_en' => 'west highland white terrier',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'cairn terrier',
                'name_en' => 'cairn terrier',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'border terrier',
                'name_en' => 'border terrier',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'crestado chino',
                'name_en' => 'crestado chino',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'samoyedo',
                'name_en' => 'samoyedo',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pastor catalán',
                'name_en' => 'pastor catalán',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'collie de pelo largo',
                'name_en' => 'collie de pelo largo',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'mastín tibetano',
                'name_en' => 'mastín tibetano',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'bulldog americano',
                'name_en' => 'bulldog americano',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'welsh corgi cardigan',
                'name_en' => 'welsh corgi cardigan',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'terrier negro ruso',
                'name_en' => 'terrier negro ruso',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'lobo de saarloos',
                'name_en' => 'lobo de saarloos',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'schnauzer gigante',
                'name_en' => 'schnauzer gigante',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'greyhound',
                'name_en' => 'greyhound',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pastor de los pirineos de pelo largo',
                'name_en' => 'pastor de los pirineos de pelo largo',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'bull terrier inglés',
                'name_en' => 'bull terrier inglés',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'boyero de berna',
                'name_en' => 'boyero de berna',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'airedale terrier',
                'name_en' => 'airedale terrier',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'ratón de praga',
                'name_en' => 'ratón de praga',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'norfolk terrier',
                'name_en' => 'norfolk terrier',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'crestado rodesiano',
                'name_en' => 'rhodesian ridgeback',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'san bernardo',
                'name_en' => 'st.bernhardshund',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'gran pirineo',
                'name_en' => 'gran pirineo',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pekinés',
                'name_en' => 'pekinés',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'terranova',
                'name_en' => 'terranova',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'mastin italiano',
                'name_en' => 'mastin italiano',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pastor bergamasco',
                'name_en' => 'pastor bergamasco',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'agua español',
                'name_en' => 'agua español',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'broholmer',
                'name_en' => 'broholmer',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'fox paulistinha',
                'name_en' => 'fox paulistinha',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'staffordshire bull terrier',
                'name_en' => 'staffordshire bull terrier',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'gran sabueso anglo-francés tricolor',
                'name_en' => 'gran sabueso anglo-francés tricolor',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'saluki',
                'name_en' => 'saluki',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pastor de los pirineos de cara rasa',
                'name_en' => 'pastor de los pirineos de cara rasa',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'nova scotia duck tolling retriever',
                'name_en' => 'nova scotia duck tolling retriever',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'skye terrier',
                'name_en' => 'skye terrier',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'schipperke',
                'name_en' => 'schipperke',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pomerania',
                'name_en' => 'pomerania',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'chesapeake bay retriever',
                'name_en' => 'chesapeake bay retriever',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'basset artesiano normando',
                'name_en' => 'basset artesiano normando',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'gran danés',
                'name_en' => 'gran danés',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pastro polaco de las llanuras',
                'name_en' => 'pastro polaco de las llanuras',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'mastín napolitano',
                'name_en' => 'mastín napolitano',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'dogo argentino',
                'name_en' => 'dogo argentino',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'dogo de burdeos',
                'name_en' => 'dogo de burdeos',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'boyero de flandes',
                'name_en' => 'boyero de flandes',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'schnauzer estándar',
                'name_en' => 'schnauzer estándar',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'bullmastiff',
                'name_en' => 'bullmastiff',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'braco húngaro (vizsla)',
                'name_en' => 'braco húngaro (vizsla)',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'dálmata',
                'name_en' => 'dálmata',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'kangal',
                'name_en' => 'kangal',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'spitz alemán',
                'name_en' => 'spitz alemán',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pastor blanco suizo',
                'name_en' => 'pastor blanco suizo',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pastor ganadero australiano',
                'name_en' => 'pastor ganadero australiano',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'beauceron',
                'name_en' => 'beauceron',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'scottish terrier',
                'name_en' => 'scottish terrier',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'bulldog francés',
                'name_en' => 'bulldog francés',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'bulldog inglés',
                'name_en' => 'bulldog inglés',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'pastor belga groenendal',
                'name_en' => 'pastor belga groenendal',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'boston terrier',
                'name_en' => 'boston terrier',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'coton de tuléar',
                'name_en' => 'coton de tuléar',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'fox terrier de pelo liso',
                'name_en' => 'fox terrier de pelo liso',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'lhasa apso',
                'name_en' => 'lhasa apso',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'papillón',
                'name_en' => 'papillón',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'galgo afgano',
                'name_en' => 'galgo afgano',
                'specie_id' => $dog->id
        ],[
                'name_es' => 'boerboel',
                'name_en' => 'boerboel',
                'specie_id' => $dog->id
        ]);

        foreach ($dogs as $race) {
            $ne_race['name'] = json_encode(['es' => $race['name_en'], 'en' => $race['name_es']]);
            $ne_race['specie_id'] = $race['specie_id'];
            Breed::create($ne_race);
        }

    }
}
