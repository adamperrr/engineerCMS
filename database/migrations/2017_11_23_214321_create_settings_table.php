<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('settingName')->unique();
            $table->text('settingValue');
            $table->enum('settingType', ['text', 'boolean', 'int', 'separator'])->default('text');
            $table->string('displayedName', 255);
            $table->text('description');
            $table->timestamps();
        });

        $settings = [

            'registrationOpen' => [
                '1',
                'Rejestracja użytkowników otwarta',
                'Pozwala na rejestrowanie się kolejnych użytkowników. Rejestracja powinna być wyłączona!',
                'boolean'
            ],

            'startPage' => [
                'list',
                'Adres strony startowej',
                'Na przykład: page/2 lub list <br>
                 W przypadku wpisania złego adresu wejdź bezpośrednio do panelu logowania przez 
                 adres /login i w ustawieniach zmień stronę na istniejącą.',
                'text'
            ],

            'separator2' => [
                '0',
                'Meta tagi',
                '',
                'separator'
            ],

            'mainEmail' => [
                'example@example.com',
                'Główny adres email',
                '',
                'text'
            ],

            'separator21' => [
                '0',
                'Meta tagi',
                '',
                'separator'
            ],

            'title' => [
                'Jan Kowalski',
                'Tytuł strony',
                'Wyświetlany w pasku przeglądarki.',
                'text'
            ],
            'keywords' => [
                'jan, kowalski, engineerCMS, politechnika, poznańska',
                'Słowa kluczowe',
                'Słowa kluczowe - meta tag',
                'text'
            ],
            'description' => [
                'Jana Kowalskiego',
                'Opis strony',
                'Opis strony - meta tag',
                'text'
            ],

            'separator3' => [
                '0',
                'Sekcje szablonu strony',
                '',
                'separator'
            ],

            'topBarTitle' => [
                'Jan Kowalski',
                'Tytuł na górnym pasku',
                '',
                'text'
            ],
            'headerTitle' => [
                'Jan Kowalski',
                'Tytuł w sekcji header',
                '',
                'text'
            ],
            'headerDescription' => [
                'Opis w sekcji header',
                'Opis w sekcji header',
                '',
                'text'],

            'footer' => [
                'Copyright © Jan Kowalski 2017',
                'Stopka strony',
                '',
                'text'],
        ];

        foreach($settings as $key => $value)
        {
            $setting = new \App\Setting();
            $setting->settingName = $key;
            $setting->settingValue = $value[0];
            $setting->settingType = $value[3];
            $setting->displayedName = $value[1];
            $setting->description = $value[2];
            $setting->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
