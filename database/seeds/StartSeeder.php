<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert([
            'nombres'=> 'Mauricio',
            'apellido_paterno' => 'Ramos',
            'apellido_materno' => 'Villaseñor',
            'rfc' => 'RAVC971212',
            'curp' => 'RAVC971212HDFMLS07',
            'fecha_nacimiento' => '1997-12-12',
            'telefono' => '5656978610',
            'grado' => 'Doctor',
            'email' => 'mauri334455@gmail.com',
            'usuario' => 'mauri334455',
            'password' => Hash::make('amores334455')
        ]);
        DB::table('salons')->insert([
            'sede'=> 'Salon 213',
            'capacidad' => 50,
            'ubicacion' => 'FI',
        ]);
        DB::table('salons')->insert([
            'sede'=> 'Salon 321',
            'capacidad' => 50,
            'ubicacion' => 'FI',
        ]);
        DB::table('salons')->insert([
            'sede'=> 'Salon J102',
            'capacidad' => 50,
            'ubicacion' => 'FI',
        ]);
        DB::table('salons')->insert([
            'sede'=> 'Salon Y001',
            'capacidad' => 50,
            'ubicacion' => 'FI',
        ]);
        DB::table('coordinacions')->insert([
            'nombre_coordinacion' => 'Formación de Desarrollo Humano',
            'abreviatura' => 'CA',
            'coordinador' => 'Diego Alberto Gomez',
            'grado' => 'M.E.M.',
            'usuario' => 'd1eg1nEZ',
            'password' => Hash::make('1234'),
            'comentarios' => 'Esta coordinacion está encargada en la parte administrativa de la FI'
        ]);

        DB::table('coordinacions')->insert([
            'nombre_coordinacion' => 'Formación Educativa',
            'abreviatura' => 'CE',
            'coordinador' => 'Alan Rodriguez Ramirez',
            'grado' => 'M.E.',
            'usuario' => 'A1an1nEZ',
            'password' => Hash::make('1234'),
            'comentarios' => 'Esta coordinación se encarga de la parte educativa de la FI'
        ]);
        DB::table('divisions')->insert([
            'nombre' => 'Ciencias Básicas',
        ]);
        DB::table('divisions')->insert([
            'nombre' => 'Geomática',
        ]);
        DB::table('divisions')->insert([
            'nombre' => 'Ingeniería Eléctrica',
        ]);
        DB::table('divisions')->insert([
            'nombre' => 'Ciencias Sociales',
        ]);

        DB:: table('facultads')->insert([
            'id' => 1,
            'nombre' =>'Facultad de Arquitectura'
        ]);
        DB:: table('facultads')->insert([
            'id' => 2,
            'nombre' =>'Facultad de Artes y Diseño'
        ]);
        DB:: table('facultads')->insert([
            'id' => 3,
            'nombre' =>'Facultad de Ciencias'
        ]);
        DB:: table('facultads')->insert([
            'id' => 4,
            'nombre' =>'Facultad de Ciencias Políticas y Sociales'
        ]);
        DB:: table('facultads')->insert([
            'id' => 5,
            'nombre' =>'Facultad de Contaduría y Administración'
        ]);
        DB:: table('facultads')->insert([
            'id' => 6,
            'nombre' =>'Facultad de Derecho'
        ]);
        DB:: table('facultads')->insert([
            'id' => 7,
            'nombre' =>'Facultad de Economía'
        ]);
        DB:: table('facultads')->insert([
            'id' => 8,
            'nombre' =>'Facultad de Estudios Superiores (FES) Acatlán'
        ]);
        DB:: table('facultads')->insert([
            'id' => 9,
            'nombre' =>'Facultad de Estudios Superiores (FES) Aragón'
        ]);
        DB:: table('facultads')->insert([
            'id' => 10,
            'nombre' =>'Facultad de Estudios Superiores (FES) Cuautitlán'
        ]);
        DB:: table('facultads')->insert([
            'id' => 11,
            'nombre' =>'Facultad de Estudios Superiores (FES) Iztacala'
        ]);
        DB:: table('facultads')->insert([
            'id' => 12,
            'nombre' =>'Facultad de Estudios Superiores (FES) Zaragoza'
        ]);
        DB:: table('facultads')->insert([
            'id' => 13,
            'nombre' =>'Facultad de Filosofía y Letras'
        ]);
        DB:: table('facultads')->insert([
            'id' => 14,
            'nombre' =>'Facultad de Ingeniería'
        ]);
        DB:: table('facultads')->insert([
            'id' => 15,
            'nombre' =>'Facultad de Medicina'
        ]);
        DB:: table('facultads')->insert([
            'id' => 16,
            'nombre' =>'Facultad de Medicina Veterinaria y Zootecnia'
        ]);
        DB:: table('facultads')->insert([
            'id' => 17,
            'nombre' =>'Facultad de Música'
        ]);
        DB:: table('facultads')->insert([
            'id' => 18,
            'nombre' =>'Facultad de Odontología'
        ]);
        DB:: table('facultads')->insert([
            'id' => 19,
            'nombre' =>'Facultad de Psicología'
        ]);
        DB:: table('facultads')->insert([
            'id' => 20,
            'nombre' =>'Facultad de Química'
        ]);
        DB:: table('facultads')->insert([
            'id' => 21,
            'nombre' =>'Centro de Física Aplicada y Tecnología Avanzada'
        ]);
        DB:: table('facultads')->insert([
            'id' => 22,
            'nombre' =>'Instituo de Energías Renovables'
        ]);
        DB:: table('facultads')->insert([
            'id' => 23,
            'nombre' =>'Centro de Nanociencias y Nanotecnología'
        ]);
        DB:: table('facultads')->insert([
            'id' => 24,
            'nombre' =>'Escuela Nacional de Estudios Superiores,Unidad Mérida'
        ]);
        DB:: table('facultads')->insert([
            'id' => 25,
            'nombre' =>'Escuela Nacional de Estudios Superiores,Unidad Morelia'
        ]);
        DB:: table('facultads')->insert([
            'id' => 26,
            'nombre' =>'Instituto de Investigaciones en Matemáticas y en Sistemas'
        ]);
        DB:: table('facultads')->insert([
            'id' => 27,
            'nombre' =>'Escuela Nacional de Enfermería y Obstetricia'
        ]);
        DB:: table('facultads')->insert([
            'id' => 28,
            'nombre' =>'Escuela Nacional de Estudios Superiores, Unidad León'
        ]);
        DB:: table('facultads')->insert([
            'id' => 29,
            'nombre' =>'Centro de Ciencias Genómicas'
        ]);
        DB:: table('facultads')->insert([
            'id' => 30,
            'nombre' =>'Escuela Nacional de Estudios Superiores, Unidad Juriquilla'
        ]);
        DB:: table('facultads')->insert([
            'id' => 31,
            'nombre' =>'Escuela Nacional de Trabajo Social'
        ]);
        DB:: table('facultads')->insert([
            'id' => 32,
            'nombre' =>'Centro Universitarios de Estudios Cinematográficos'
        ]);
        DB:: table('facultads')->insert([
            'id' => 33,
            'nombre' =>'Centro Universitario de Teatro'
        ]);
        DB:: table('facultads')->insert([
            'id' => 34,
            'nombre' =>'Escuela Nacional de Lenguas, Lingúistica y Traducción'
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Actuaría',
            'clave' => 101,
            'id_division' => 1,
            'id_facultad' => 3,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Arquitectura',
            'clave' => 102,
            'id_division' => 1,
            'id_facultad' => 1,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Arquitectura del paisaje',
            'clave' => 103,
            'id_division' => 1,
            'id_facultad' => 1,

        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Ciencias de la Computación',
            'clave' => 104,
            'id_division' => 1,
            'id_facultad' => 3,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Diseño Industrial',
            'clave' => 105,
            'id_division' => 1,
            'id_facultad' => 1,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Física',
            'clave' => 106,
            'id_division' => 1,
            'id_facultad' => 3,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Ingeniería Civil',
            'clave' => 107,
            'id_division' => 1,
            'id_facultad' => 14,

        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Ingeniería de Minas y Metalurgía',
            'clave' => 108,
            'id_division' => 1,
            'id_facultad' => 14,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Ingeniería Eléctrica y Eletrónica',
            'clave' => 109,
            'id_division' => 1,
            'id_facultad' => 14,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Ingeniería en Computación',
            'clave' => 110,
            'id_division' => 1,
            'id_facultad' => 14,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Ingeniería en Telecomunicaciones',
            'clave' => 111,
            'id_division' => 1,
            'id_facultad' => 14,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Ingeniería Geofísica',
            'clave' => 112,
            'id_division' => 1,
            'id_facultad' => 14,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Ingeniería Geológica',
            'clave' => 113,
            'id_division' => 1,
            'id_facultad' => 14,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Ingeniería Industrial',
            'clave' => 114,
            'id_division' => 1,
            'id_facultad' => 14,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Ingeniería Mecánica',
            'clave' => 115,
            'id_division' => 1,
            'id_facultad' => 14,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Ingeniería Mecánica Eléctrica',
            'clave' => 116,
            'id_division' => 1,
            'id_facultad' => 14,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Ingeniería Petrolera',
            'clave' => 117,
            'id_division' => 1,
            'id_facultad' => 14,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Ingeniería Química',
            'clave' => 118,
            'id_division' => 1,
            'id_facultad' => 20,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Ingeniería Química Metalurgia',
            'clave' => 119,
            'id_division' => 1,
            'id_facultad' => 20,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Ingeniería Topográfica y Geodesica',
            'clave' => 120,
            'id_division' => 1,
            'id_facultad' => 14,

        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Ingenieria electrica',
            'clave' => 1231,
            'id_division' => 1,
            'id_facultad' => 14,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Matemáticas Aplicadas y Computación',
            'clave' => 121,
            'id_division' => 1,
            'id_facultad' => 8,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Matemáticas',
            'clave' => 122,
            'id_division' => 1,
            'id_facultad' => 3,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Urbanismo',
            'clave' => 123,
            'id_division' => 1,
            'id_facultad' =>  1,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Ingeniería Mecatrónica',
            'clave' => 124,
            'id_division' => 1,
            'id_facultad' => 14,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Ingeniería Geomática',
            'clave' => 125,
            'id_division' => 1,
            'id_facultad' => 14,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Tecnología',
            'clave' => 126,
            'id_division' => 1,
            'id_facultad' => 10,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Ciencias de la Tierra',
            'clave' => 127,
            'id_division' => 1,
            'id_facultad' => 3,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Ingeniería en Energías Renovables',
            'clave' => 128,
            'id_division' => 1,
            'id_facultad' => 22,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Nanotecnología',
            'clave' => 129,
            'id_division' => 1,
            'id_facultad' => 23,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Ingeniería en Telecomunicaciones, Sistemas y Electrónica',
            'clave' => 130,
            'id_division' => 1,
            'id_facultad' => 10,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Geociencias',
            'clave' => 131,
            'id_division' => 1,
            'id_facultad' => 25,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Tecnologías para la información en ciencias',
            'clave' => 132,
            'id_division' => 1,
            'id_facultad' => 25,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Ciencia de Materiales Sustentables',
            'clave' => 133,
            'id_division' => 1,
            'id_facultad' => 25,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Física Biomédica',
            'clave' => 134,
            'id_division' => 1,
            'id_facultad' => 3,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Ingeniería en Sistemas Biomédicos',
            'clave' => 135,
            'id_division' => 1,
            'id_facultad' => 14,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Matemáticas Aplicadas',
            'clave' => 136,
            'id_division' => 1,
            'id_facultad' => 3,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Ingeniería Ambiental',
            'clave' => 137,
            'id_division' => 1,
            'id_facultad' => 14,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Ciencia de Datos',
            'clave' => 138,
            'id_division' => 1,
            'id_facultad' => 26,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Biología',
            'clave' => 201,
            'id_division' => 2,
            'id_facultad' => 11,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Biología',
            'clave' => 201,
            'id_division' => 2,
            'id_facultad' => 3,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Cirujano Dentista',
            'clave' => 202,
            'id_division' => 2,
            'id_facultad' => 11,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Enfermería y Obstetricia',
            'clave' => 203,
            'id_division' => 2,
            'id_facultad' => 27,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Ingeniería Agrícola',
            'clave' => 204,
            'id_division' => 2,
            'id_facultad' => 10,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Ingeniería en Alimentos',
            'clave' => 205,
            'id_division' => 2,
            'id_facultad' => 10,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Investigación Biomédica Básica',
            'clave' => 206,
            'id_division' => 2,
            'id_facultad' => 15,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Medicina Veterinaria y Zootecnia',
            'clave' => 207,
            'id_division' => 2,
            'id_facultad' => 10,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Médico Cirujano',
            'clave' => 208,
            'id_division' => 2,
            'id_facultad' => 11,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Optometría',
            'clave' => 209,
            'id_division' => 2,
            'id_facultad' => 11,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Psicología',
            'clave' => 210,
            'id_division' => 2,
            'id_facultad' => 11,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Psicología',
            'clave' => 441,
            'id_division' => 2,
            'id_facultad' => 19,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Economía',
            'clave' => 442,
            'id_division' => 2,
            'id_facultad' => 7
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Economía',
            'clave' => 443,
            'id_division' => 2,
            'id_facultad' => 7
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Veterinario Zootecnista',
            'clave' => 444,
            'id_division' => 2,
            'id_facultad' => 10,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Química de Alimentos',
            'clave' => 212,
            'id_division' => 2,
            'id_facultad' => 20,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Química Farmacéutico Biológica',
            'clave' => 213,
            'id_division' => 2,
            'id_facultad' => 20,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Química Industrial',
            'clave' => 214,
            'id_division' => 2,
            'id_facultad' => 10,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Ciencias Genómicas',
            'clave' => 215,
            'id_division' => 2,
            'id_facultad' => 29,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Ciencias Ambientales',
            'clave' => 216,
            'id_division' => 2,
            'id_facultad' => 24,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Manejo Sustentable de Zonas Costeras',
            'clave' => 217,
            'id_division' => 2,
            'id_facultad' => 24,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Bioquímica Diagnóstica',
            'clave' => 218,
            'id_division' => 2,
            'id_facultad' => 10,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Farmacia',
            'clave' => 219,
            'id_division' => 2,
            'id_facultad' => 10,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Enfermería',
            'clave' => 220,
            'id_division' => 2,
            'id_facultad' => 11,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Fisioterapia',
            'clave' => 221,
            'id_division' => 2,
            'id_facultad' => 28,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Odontología',
            'clave' => 222,
            'id_division' => 2,
            'id_facultad' => 18,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Ciencias Agrogenómicas',
            'clave' => 223,
            'id_division' => 2,
            'id_facultad' => 28,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Ciencia Forense',
            'clave' => 224,
            'id_division' => 2,
            'id_facultad' => 15,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Ecología',
            'clave' => 225,
            'id_division' => 2,
            'id_facultad' => 25,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Neurociencias',
            'clave' => 226,
            'id_division' => 2,
            'id_facultad' => 30,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Nutriología',
            'clave' => 227,
            'id_division' => 2,
            'id_facultad' => 12,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Ortesis y Prótesis',
            'clave' => 228,
            'id_division' => 2,
            'id_facultad' => 30,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Química e Ingeniería en Materiales',
            'clave' => 229,
            'id_division' => 2,
            'id_facultad' => 20,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Administración',
            'clave' => 301,
            'id_division' => 3,
            'id_facultad' => 10,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Ciencias de la Comunicación (Periodismo)',
            'clave' => 302,
            'id_division' => 3,
            'id_facultad' => 4,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Ciencias Políticas y Administración Pública',
            'clave' => 303,
            'id_division' => 3,
            'id_facultad' => 8,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Contaduría',
            'clave' => 304,
            'id_division' => 3,
            'id_facultad' => 10,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Derecho',
            'clave' => 305,
            'id_division' => 3,
            'id_facultad' => 6,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Economía',
            'clave' => 306,
            'id_division' => 3,
            'id_facultad' => 8,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Geografía',
            'clave' => 307,
            'id_division' => 3,
            'id_facultad' => 13,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Informática',
            'clave' => 308,
            'id_division' => 3,
            'id_facultad' => 10,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Planificación para el Desarrollo AGR',
            'clave' => 309,
            'id_division' => 3,
            'id_facultad' => 9,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Relaciones Internacionales',
            'clave' => 310,
            'id_division' => 3,
            'id_facultad' => 8,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Sociología',
            'clave' => 311,
            'id_division' => 3,
            'id_facultad' => 8,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Trabajo Social',
            'clave' => 312,
            'id_division' => 3,
            'id_facultad' => 31,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Economía Industrial',
            'clave' => 313,
            'id_division' => 3,
            'id_facultad' => 28,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Administración Agropecuaria',
            'clave' => 314,
            'id_division' => 3,
            'id_facultad' => 28,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Comunicación',
            'clave' => 315,
            'id_division' => 3,
            'id_facultad' => 28,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Comunicación y Periodismo',
            'clave' => 316,
            'id_division' => 3,
            'id_facultad' => 9,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Estudios Sociales y Gestión Local',
            'clave' => 317,
            'id_division' => 3,
            'id_facultad' => 25,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Desarrollo Comunitario para el Envejecimiento',
            'clave' => 318,
            'id_division' => 3,
            'id_facultad' => 12,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Antropología',
            'clave' => 319,
            'id_division' => 3,
            'id_facultad' => 4,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Desarrollo Territorial',
            'clave' => 320,
            'id_division' => 3,
            'id_facultad' => 28,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Negocios Internacionales',
            'clave' => 321,
            'id_division' => 3,
            'id_facultad' => 30,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Geografía Aplicada',
            'clave' => 322,
            'id_division' => 3,
            'id_facultad' => 24,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Artes Visuales',
            'clave' => 401,
            'id_division' => 4,
            'id_facultad' => 2,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Bibliotecnología',
            'clave' => 402,
            'id_division' => 4,
            'id_facultad' => 13,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Canto',
            'clave' => 403,
            'id_division' => 4,
            'id_facultad' => 17,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Composición',
            'clave' => 404,
            'id_division' => 4,
            'id_facultad' => 17,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Diseño y Comunicación Visual',
            'clave' => 405,
            'id_division' => 4,
            'id_facultad' => 10,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Diseño Gráfico',
            'clave' => 406,
            'id_division' => 4,
            'id_facultad' => 8,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Educación Musical',
            'clave' => 407,
            'id_division' => 4,
            'id_facultad' => 17,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Enseñanza de Inglés',
            'clave' => 408,
            'id_division' => 4,
            'id_facultad' => 8,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Estudios Latinoamericanos',
            'clave' => 409,
            'id_division' => 4,
            'id_facultad' => 13,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Etnomusicología',
            'clave' => 410,
            'id_division' => 4,
            'id_facultad' => 17,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Filosofía',
            'clave' => 411,
            'id_division' => 4,
            'id_facultad' => 8,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Historia',
            'clave' => 412,
            'id_division' => 4,
            'id_facultad' => 8,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Instrumentista',
            'clave' => 413,
            'id_division' => 4,
            'id_facultad' => 17,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Lengua y Literaturas Hispánicas',
            'clave' => 414,
            'id_division' => 4,
            'id_facultad' => 8,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Lengua y Lit. Modernas Alemanas',
            'clave' => 415,
            'id_division' => 1,
            'id_facultad' => 13,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Lengua y Lit. Modernas Francesas',
            'clave' => 416,
            'id_division' => 4,
            'id_facultad' => 13,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Lengua y Lit. Modernas Inglesas',
            'clave' => 417,
            'id_division' => 4,
            'id_facultad' => 13,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Lengua y Lit. Modernas Italianas',
            'clave' => 418,
            'id_division' => 4,
            'id_facultad' => 13,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Letras Clásicas',
            'clave' => 419,
            'id_division' => 4,
            'id_facultad' => 13,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Literatura Dramática y Teatro',
            'clave' => 420,
            'id_division' => 4,
            'id_facultad' => 13,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Pedagogía',
            'clave' => 421,
            'id_division' => 4,
            'id_facultad' => 8,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Piano',
            'clave' => 422,
            'id_division' => 4,
            'id_facultad' => 17,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Enseñanza de Alemán como Lengua Extranjera',
            'clave' => 424,
            'id_division' => 4,
            'id_facultad' => 8,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Enseñanza de Español como Lengua Extranjera',
            'clave' => 425,
            'id_division' => 4,
            'id_facultad' => 8,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Enseñanza de Francés como Lengua Extranjera',
            'clave' => 426,
            'id_division' => 4,
            'id_facultad' => 8,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Enseñanza de Inglés como Lengua Extranjera',
            'clave' => 427,
            'id_division' => 4,
            'id_facultad' => 8,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Enseñanza de Italiano como Lengua Extranjera',
            'clave' => 428,
            'id_division' => 4,
            'id_facultad' => 8,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Desarrollo y Gestión Interculturales',
            'clave' => 429,
            'id_division' => 4,
            'id_facultad' => 13,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Lengua y Lit. Modernas Portuguesas',
            'clave' => 430,
            'id_division' => 4,
            'id_facultad' => 13,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Geohistoria',
            'clave' => 431,
            'id_division' => 4,
            'id_facultad' => 25,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Literatura Intercultural',
            'clave' => 432,
            'id_division' => 4,
            'id_facultad' => 25,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Historia del Arte',
            'clave' => 433,
            'id_division' => 4,
            'id_facultad' => 25,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Arte y Diseño',
            'clave' => 434,
            'id_division' => 4,
            'id_facultad' => 25,
        ]);

        DB::table('carreras')->insert([
            'nombre' => 'Cinematografía',
            'clave' => 435,
            'id_division' => 4,
            'id_facultad' => 32,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Teatro y Actuación',
            'clave' => 436,
            'id_division' => 4,
            'id_facultad' => 33,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Administración de Archivos y Gestión Documental',
            'clave' => 437,
            'id_division' => 4,
            'id_facultad' => 25,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Música y Tecnología Artística',
            'clave' => 438,
            'id_division' => 4,
            'id_facultad' => 25,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Lingüística Aplicada',
            'clave' => 439,
            'id_division' => 4,
            'id_facultad' => 34,
        ]);
        DB::table('carreras')->insert([
            'nombre' => 'Traducción',
            'clave' => 440,
            'id_division' => 4,
            'id_facultad' => 1,
        ]);

        DB::table('categoria_nivel')->insert(['categoria' => 'Administrativo', 'abreviatura' => 'Adm']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Ayudante de profesor A', 'abreviatura' => 'AYTE PROF A']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Ayudante de profesor B', 'abreviatura' => 'AYTE PROF B']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Funcionario', 'abreviatura' => 'FUNC']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Investigador Asociado B TC', 'abreviatura' => 'INV ASOC B TC']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Investigador titular A TC', 'abreviatura' => 'INV TIT A T C']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Investigador titular B MT', 'abreviatura' => 'INV TIT B M  T']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Investigador titular B TC', 'abreviatura' => 'INV TIT B T  C']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Investigador titular C MT', 'abreviatura' => 'INV TIT C M  T']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Investigador titular C TC', 'abreviatura' => 'INV TIT C T  C']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Profesor Emérito', 'abreviatura' => 'PROF EMERITO']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Profesor Titular A TC', 'abreviatura' => 'PROF TIT A T C']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Profesor Titular B TC', 'abreviatura' => 'PROF TIT B T C']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Profesor Titular C TC', 'abreviatura' => 'PROF TIT C T C']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Técnico Asociado A TC', 'abreviatura' => 'TEC ASOC A T C']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Técnico Asociado B TC', 'abreviatura' => 'TEC ASOC B T C']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Técnico Asociado C TC', 'abreviatura' => 'TEC ASOC C T C']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Técnico Auxiliar A TC', 'abreviatura' => 'TEC AUX A T C']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Técnico Auxiliar B MT', 'abreviatura' => 'TEC AUX B M T']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Técnico Auxiliar B TC', 'abreviatura' => 'TEC AUX B T C']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Técnico Auxiliar C TC', 'abreviatura' => 'TEC AUX C T C']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Técnico Titular A TC', 'abreviatura' => 'TEC TIT A T C']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Técnico Titular B TC', 'abreviatura' => 'TEC TIT B T C']);
        DB::table('categoria_nivel')->insert(['categoria' => 'Técnico Titular C TC', 'abreviatura' => 'TEC TIT C T C']);

        DB::table('profesors')->insert([
            'nombres' => 'Juan',
            'apellido_paterno' => 'Ramirez',
            'apellido_materno' => 'Gonzales',
            'rfc' => 'RAGJ720101T72',
            'curp' =>'RAGJ720101HMCMNN08',
            'numero_trabajador' => '12143231',
            'categoria_nivel_id'=>1,
            'fecha_nacimiento' => '1972-01-01',
            'telefono' => '55664487',
            'grado' => 'Maestría',
            'email' => 'carosiim.sdco@gmail.com',
            'semblanza_corta'=> 'Doctorado en Inteligencia Artificial,
                             su carrera es respaldada por 25 años de 
                             ejercer la doctrina de profesor. Ganó el premio
                             S@T por el código más pequeño del mundo',
            'genero' => 'masculino',
            'comentarios' => 'hombre alto, de tez blanca, cabello negro y ojos marrones. ',
            'facebook' => 'Juan Ramirez',
            'unam' => false,
            'procedencia'=> 'Universidad Miskatonic'

        ]);
        DB::table('profesors')->insert([
            'nombres' => 'Marta',
            'apellido_paterno' => 'Suarez',
            'apellido_materno' => 'Prados',
            'rfc' => 'SUPM720101D11',
            'numero_trabajador' => '12143232',
            'curp' =>'SUPM720101MMCRRR03',
            'categoria_nivel_id'=>1,
            'fecha_nacimiento' => '1972-01-01',
            'telefono' => '557458963',
            'grado' => 'Licenciatura',
            'email' => 'MSP@gmail.com',
            'semblanza_corta' => 'Profesora de la facultad de ingeniería,
                             fundó la asociación de mujeres programadoras
                             con el fin de impulsar los derechos y la presencia
                             de la mujer en el ámbito profesional de las Tecnologías
                             de la Información. Es egresada de la Facultad de Ciencias.
                             Doctora en análisis de datos.',
            'genero' => 'femenino',
            'comentarios' => 'Mujer delgada, de tez morena, cabello negro y ojos cafes.',
            'facebook' => 'Martha Suarez',
            'unam' => true,
            'facultad_id' =>1,
            'carrera_id' =>1,

        ]);
        DB::table('profesors')->insert([
            'nombres' => 'Santiago',
            'apellido_paterno' => 'Hernández',
            'apellido_materno' => 'Gonzales',
            'rfc' => 'HEGS720517RJ3',
            'numero_trabajador' => '12143233',
            'curp' =>'HEGS720517HMCRNN00',
            'categoria_nivel_id'=>1,
            'fecha_nacimiento' => '1972-05-17',
            'telefono' => '55664487',
            'grado' => 'Ingeniería',
            'email' => 'prof2@gmail.com',
            'semblanza_corta' => 'Ingeniero geofisico, con especilidad en volcanes y terremotos y maestria en rocas.',
            'genero' => 'masculino',
            'comentarios' => 'Señor alto, edad avanzada, pelo y barba canosas y usa lentes',
            'facebook' => 'face',
            'unam' => true,
            'facultad_id' =>14,
            'carrera_id' =>12,

        ]);
        DB::table('profesors')->insert([
            'nombres' => 'Melina',
            'apellido_paterno' => 'Pelcastre',
            'apellido_materno' => 'Prados',
            'rfc' => 'PEPM720517IW2',
            'numero_trabajador' => '12143234',
            'curp' =>'PEPM720517MMCLRL04',
            'categoria_nivel_id'=>1,
            'fecha_nacimiento' => '1972-05-017',
            'telefono' => '557458963',
            'grado' => 'Licenciatura',
            'email' => 'MSP2@gmail.com',
            'semblanza_corta' => 'Licenciada en administracion egresada de la FCyA de la UNAM con honores.',
            'genero' => 'femenino',
            'comentarios' => 'Mujer bajita, tez obscura, cabello negro.',
            'facebook' => 'MyFace',
            'unam' => true,
            'facultad_id' =>5,
            'carrera_id' =>1,

        ]);
        DB::table('profesors')->insert([
            'nombres' => 'Mateo',
            'apellido_paterno' => 'Juarez',
            'apellido_materno' => 'Fernández',
            'rfc' => 'JUFM720101M74',
            'numero_trabajador' => '12143235',
            'curp' =>'JUFM720101HMCRRT03',
            'categoria_nivel_id'=>5,
            'fecha_nacimiento' => '1972-01-01',
            'telefono' => '55664487',
            'grado' => 'Carrera Tecnica',
            'email' => 'prof3@gmail.com',
            'semblanza_corta' => 'Ingeniero mecanico con especialidad en diseño mecanico egresado de la unam y con maestria en Alemania.',
            'genero' => 'masculino',
            'comentarios' => 'Hombre alto, calvo y con barba muy grande',
            'facebook' => 'Mateo Juarez',
            'unam' => true,
            'facultad_id' =>14,
            'carrera_id' =>7,

        ]);
        DB::table('profesors')->insert([
            'nombres' => 'Gabriela',
            'apellido_paterno' => 'González',
            'apellido_materno' => 'Velázquez',
            'rfc' => 'GOVG720101FZ6',
            'numero_trabajador' => '12143236',
            'curp' =>'GOVG720101MMCNLB07',
            'categoria_nivel_id'=>1,
            'fecha_nacimiento' => '1972-01-01',
            'telefono' => '557458963',
            'grado' => 'Doctorado',
            'email' => 'MSP3@gmail.com',
            'semblanza_corta' => 'Ingeniera industrial, con un MBA en inglaterra y tambien trabaja en Coca Cola.',
            'genero' => 'femenino',
            'comentarios' => 'Mujer de edad avanzada, cabello negro y orejas grandes',
            'facebook' => 'Gaby Gonzalez',
            'unam' => true,
            'facultad_id' =>14,
            'carrera_id' =>13,
        ]);
        DB::table('profesors')->insert([
            'nombres' => 'Luis Daniel',
            'apellido_paterno' => 'Velásquez',
            'apellido_materno' => 'Velázquez',
            'rfc' => 'VEVL720101T65',
            'numero_trabajador' => '12143237',
            'curp' =>'VEVL720101HMCLLS07',
            'categoria_nivel_id'=>7,
            'fecha_nacimiento' => '1972-01-01',
            'telefono' => '55664487',
            'grado' => 'Maestría',
            'email' => 'prof4@gmail.com',
            'semblanza_corta' => 'Ingeniero en telecomunicaciones y estudia actualmente su segunda carrera, en economia.',
            'genero' => 'masculino',
            'comentarios' => 'Hombre de mucho peso, estatura promedio y larga cabellera rubia',
            'facebook' => 'Dani Velásquez',
            'unam' => true,
            'facultad_id' =>14,
            'carrera_id' =>9,
        ]);
        DB::table('profesors')->insert([
            'nombres' => 'Fernanda',
            'apellido_paterno' => 'Núñez',
            'apellido_materno' => 'Sandoval',
            'rfc' => 'NUSF720101I63',
            'numero_trabajador' => '12143238',
            'curp' =>'NUSF720101MMCXNR08',
            'categoria_nivel_id'=>1,
            'fecha_nacimiento' => '1972-01-01',
            'telefono' => '557458963',
            'grado' => 'Maestría',
            'email' => 'MSP4@gmail.com',
            'semblanza_corta' => 'Ingeniera civil, maestria en puentes y con especialidad en puentes muy grandes.',
            'genero' => 'femenino',
            'comentarios' => 'Mujer joven, alta, cabello negro y tez blanca',
            'facebook' => 'Fer Sandoval',
            'unam' => true,
            'facultad_id' =>14,
            'carrera_id' =>11,

        ]);
        DB::table('profesors')->insert([
            'nombres' => 'Ángel',
            'apellido_paterno' => 'García',
            'apellido_materno' => 'Casares',
            'rfc' => 'GACA720101EL4',
            'numero_trabajador' => '12143239',
            'curp' =>'GACA720101HMCRSN09',
            'categoria_nivel_id'=>11,
            'fecha_nacimiento' => '1972-01-01',
            'telefono' => '55664487',
            'grado' => 'Maestría',
            'email' => 'prof5@gmail.com',
            'semblanza_corta' => 'Ingeniero petrolero, actualmente se desempeña tambien en cargos altos en PEMEX',
            'genero' => 'masculino',
            'comentarios' => 'Hombre de mediana edad, cabello negro y barba de candado',
            'facebook' => 'Angel García Caseres',
            'unam' => true,
            'facultad_id' =>14,
            'carrera_id' =>10,
        ]);
        DB::table('profesors')->insert([
            'nombres' => 'Vivian',
            'apellido_paterno' => 'Salcedo',
            'apellido_materno' => 'Víquez',
            'rfc' => 'SAVV720101RV2',
            'numero_trabajador' => '12143240',
            'curp' =>'SAVV720101MMCLQV01',
            'categoria_nivel_id'=>4,
            'fecha_nacimiento' => '1972-01-01',
            'telefono' => '557458963',
            'grado' => 'Maestría',
            'email' => 'MSP5@gmail.com',
            'semblanza_corta' => 'Licenciada en contaduria, con maestria en impuestos empresariales y doctorado en contaduria para Macroempresas.',
            'genero' => 'femenino',
            'comentarios' => 'Mujer de baja estatura, delgada y con ojos cafes.',
            'facebook' => 'Vivi Salcedo',
            'unam' => true,
            'facultad_id' =>5,
            'carrera_id' =>10,
        ]);


        DB::table('profesors')->insert([
            'nombres' => 'Arturo',
            'apellido_paterno' => 'Galván',
            'apellido_materno' => 'Argote',
            'rfc' => 'GAAA720101HY0',
            'numero_trabajador' => '12143241',
            'curp' =>'GAAA720101HMCLRR05',
            'categoria_nivel_id'=>5,
            'fecha_nacimiento' => '1972-01-01',
            'telefono' => '55664487',
            'grado' => 'Maestría',
            'email' => 'prof6@gmail.com',
            'semblanza_corta' => 'Arquitecto con especialidad en paisajismo. Actualmente está creando su propia consultura',
            'genero' => 'masculino',
            'comentarios' => 'Hombre con rascos asiaticos, tez blanca y ojos rasgados.',
            'facebook' => 'Arturo Galvan',
            'unam' => true,
            'facultad_id' =>1,
            'carrera_id' =>11,

        ]);
        DB::table('profesors')->insert([
            'nombres' => 'Melissa',
            'apellido_paterno' => 'Valles',
            'apellido_materno' => 'Hernández',
            'rfc' => 'VAHM720101Q41',
            'numero_trabajador' => '12143242',
            'curp' =>'VAHM720101MMCLRL06',
            'categoria_nivel_id'=>1,
            'fecha_nacimiento' => '1972-01-01',
            'telefono' => '557458963',
            'grado' => 'Maestría',
            'email' => 'MSP6@gmail.com',
            'semblanza_corta' => 'Licenciada en arquitectura con maestria en diseño de interiores ',
            'genero' => 'femenino',
            'comentarios' => 'Mujer afroamericana de alta estatura y cabello cafe.',
            'facebook' => 'Melissaa Valles',
            'unam' => true,
            'facultad_id' =>1,
            'carrera_id' =>1,

        ]);
        DB::table('profesors')->insert([
            'nombres' => 'Roberto',
            'apellido_paterno' => 'Sánchez',
            'apellido_materno' => 'Gonzales',
            'rfc' => 'SAGR720101JR0',
            'numero_trabajador' => '12143243',
            'curp' =>'SAGR720101HMCNNB06',
            'categoria_nivel_id'=>1,
            'fecha_nacimiento' => '1972-01-01',
            'telefono' => '55664487',
            'grado' => 'Maestría',
            'email' => 'prof7@gmail.com',
            'semblanza_corta' => 'Ingeniero en Minas, con especialidad en minas de carbon y diamante.',
            'genero' => 'masculino',
            'comentarios' => 'Hombre alto, afroamericano con cabello negro.',
            'facebook' => 'Roberto Sanchez',
            'unam' => true,
            'facultad_id' =>14,
            'carrera_id' =>12,

        ]);
        DB::table('profesors')->insert([
            'nombres' => 'Daniela',
            'apellido_paterno' => 'Arjona',
            'apellido_materno' => 'Valle',
            'rfc' => 'AOVD720101DQ6',
            'numero_trabajador' => '12143244',
            'curp' =>'AOVD720101MMCRLN09',
            'categoria_nivel_id'=>1,
            'fecha_nacimiento' => '1972-05-017',
            'telefono' => '557458963',
            'grado' => 'Maestría',
            'email' => 'MSP7@gmail.com',
            'semblanza_corta' => 'Ingeniera en Sistemas Biómedicos, egresada del ITAM',
            'genero' => 'femenino',
            'comentarios' => 'Mujer de corta estatura, ojos azules y cabello color cafe',
            'facebook' => 'Dani Arjona',
            'unam' => true,
            'facultad_id' =>5,
            'carrera_id' =>1,

        ]);
        DB::table('profesors')->insert([
            'nombres' => 'Alejandro',
            'apellido_paterno' => 'López',
            'apellido_materno' => 'Mateos',
            'rfc' => 'LOMA720101EU3',
            'numero_trabajador' => '12143245',
            'curp' =>'LOMA720101HMCPTL06',
            'categoria_nivel_id'=>5,
            'fecha_nacimiento' => '1972-01-01',
            'telefono' => '55664487',
            'grado' => 'Maestría',
            'email' => 'prof8@gmail.com',
            'semblanza_corta' => 'Ingeniero mecanico con especialidad en termofluidos actualmente trabaja para Ferrari.',
            'genero' => 'masculino',
            'comentarios' => 'Hombre de baja estatura, sin cabello y utiliza lentes',
            'facebook' => 'Alex López Mateos',
            'unam' => true,
            'facultad_id' =>14,
            'carrera_id' =>7,

        ]);
        DB::table('profesors')->insert([
            'nombres' => 'Julia',
            'apellido_paterno' => 'Domínguez',
            'apellido_materno' => 'Méndez',
            'rfc' => 'DOMJ7201011Q9',
            'numero_trabajador' => '12143246',
            'curp' =>'DOMJ720101MMCMNL03',
            'categoria_nivel_id'=>1,
            'fecha_nacimiento' => '1972-01-01',
            'telefono' => '557458963',
            'grado' => 'Maestría',
            'email' => 'MSP8@gmail.com',
            'semblanza_corta' => 'Ingeniera insdustrial enfocada al area de logistica con maestry en cadena de suministros en Canada.',
            'genero' => 'femenino',
            'comentarios' => 'Mujer de edad avanzada con pelo rubio y orejas grandes.',
            'facebook' => 'Julia Dominguez',
            'unam' => true,
            'facultad_id' =>14,
            'carrera_id' =>13,
        ]);
        DB::table('profesors')->insert([
            'nombres' => 'Luis Fernando',
            'apellido_paterno' => 'Méndez',
            'apellido_materno' => 'Vallesteros',
            'rfc' => 'MEVL720101GV4',
            'numero_trabajador' => '12143247',
            'curp' =>'MEVL720101HMCNLS07',
            'categoria_nivel_id'=>7,
            'fecha_nacimiento' => '1972-01-01',
            'telefono' => '55664487',
            'grado' => 'Maestría',
            'email' => 'prof9@gmail.com',
            'semblanza_corta' => 'Ingeniero en telecomunicaciones que trabaja con la super computadora de la UNAM',
            'genero' => 'masculino',
            'comentarios' => 'Hombre con enanismo, de tez blanca y pelo negro.',
            'facebook' => 'Luis Méndez',
            'unam' => true,
            'facultad_id' =>14,
            'carrera_id' =>9,
        ]);
        DB::table('profesors')->insert([
            'nombres' => 'Hilda',
            'apellido_paterno' => 'Ramírez',
            'apellido_materno' => 'Ramírez',
            'rfc' => 'RARH720101DMA',
            'numero_trabajador' => '12143248',
            'curp' =>'RARH720101MMCMML06',
            'categoria_nivel_id'=>1,
            'fecha_nacimiento' => '1972-01-01',
            'telefono' => '557458963',
            'grado' => 'Maestría',
            'email' => 'MSP9@gmail.com',
            'semblanza_corta' => 'Ingeniera civil, socia de Carlos Slim y con maestria en carreteras',
            'genero' => 'femenino',
            'comentarios' => 'Mujer alta, delgada, con el pelo pintado de azul.',
            'facebook' => 'Hilda Ramirez',
            'unam' => true,
            'facultad_id' =>14,
            'carrera_id' =>11,

        ]);
        DB::table('profesors')->insert([
            'nombres' => 'Juan',
            'apellido_paterno' => 'Macedo',
            'apellido_materno' => 'Jiménez',
            'rfc' => 'MAJJ720101GF7',
            'numero_trabajador' => '12143249',
            'curp' =>'MAJJ720101HMCCMN02',
            'categoria_nivel_id'=>11,
            'fecha_nacimiento' => '1972-01-01',
            'telefono' => '55664487',
            'grado' => 'Maestría',
            'email' => 'prof10@gmail.com',
            'semblanza_corta' => 'Ingeniero petrolero, trabaja en paises arabes y es de los hombres más ricos del mundo',
            'genero' => 'masculino',
            'comentarios' => 'Hombre alto, con mucha musculatura, pelo y barba de color castaño claro.',
            'facebook' => 'Juan Macedo',
            'unam' => true,
            'facultad_id' =>14,
            'carrera_id' =>10,
        ]);
        DB::table('profesors')->insert([
            'nombres' => 'Viridiana',
            'apellido_paterno' => 'Valencia',
            'apellido_materno' => 'Manso',
            'rfc' => 'VAMV720101HZA',
            'numero_trabajador' => '12143250',
            'curp' =>'VAMV720101MMCLNR05',
            'categoria_nivel_id'=>4,
            'fecha_nacimiento' => '1972-01-01',
            'telefono' => '557458963',
            'grado' => 'Maestría',
            'email' => 'MSP10@gmail.com',
            'semblanza_corta' => 'Licencidad en contaduria, ella calcula los imppuestos de la unam y tiene maestria en impuestos universitarios.',
            'genero' => 'femenino',
            'comentarios' => 'Mujer de estatura promedio, de tez morena con nariz grande y pelo negro',
            'facebook' => 'Viridiana Valencia',
            'unam' => true,
            'facultad_id' =>5,
            'carrera_id' =>10,
        ]);

        DB::table('catalogo_cursos')->insert([
            'nombre_curso' =>'Programacion Estructurada',
            'duracion_curso' => '10',
            'coordinacion_id' => 1,
            'tipo' => 'CT',
            'institucion' => 'CD',
            'presentacion' => 'Presentacion',
            'dirigido' => 'Personas interesadas en el área 
                            de la programación, desarrollo de software 
                            y tecnologías de la información',
            'objetivo' => 'Enseñar las bases de todos los paradigmas de la programación
                            y mostrar la ventana de oportunidades que libera',
            'contenido' => '-¿Qué es la programación?
                            -Paradigmas de programación
                            -Lenguajes de programación
                            -Ejercicios
                            -Ejemplos en la vida diaria
                            -Temas avanzados',
            'sintesis' => 'Sintesis',
            'metodologia' => 'Metodologia',
            'acreditacion' => '10% Tareas
            90% Examen',
            'previo' => 'Conocimientos básicos de informática y tecnologías de información: Qué es una computadora y cómo funciona',
            'evaluacion' => 'Examen',
            'bibliografia' => 'www.paginasobreprogramacion.com
            A.J. Tyson, Programacion para dummys. Pearson, 2008.',
            'fecha_disenio' => '2018-05-18',
            'clave_curso' => 'ADFVJ0911598'

        ]);
        DB::table('catalogo_cursos')->insert([
            'nombre_curso' =>'Administración',
            'duracion_curso' => '20',
            'coordinacion_id' => 1,
            'tipo' => 'E',
            'institucion' => 'DGAPA',
            'presentacion' => 'Presentacion',
            'dirigido' => 'Administradores',
            'objetivo' => 'Que los que tomen el curso refuerzen sus conocimientos administrativos',
            'contenido' => 'Que es la administracion y sus derivados',
            'sintesis' => 'Se aprendera sobre la administracion',
            'metodologia' => 'Presencial',
            'acreditacion' => 'Diploma de la FI',
            'evaluacion' => 'Examen',
            'bibliografia' => 'El libro sobre administracion',
            'fecha_disenio' => '2018-05-18',
            'clave_curso' => 'FJHCZC'

        ]);
        DB::table('catalogo_cursos')->insert([
            'nombre_curso' =>'Administración',
            'duracion_curso' => '20',
            'coordinacion_id' => 1,
            'tipo' => 'C',
            'institucion' => 'DGAPA',
            'presentacion' => 'Presentacion',
            'dirigido' => 'Gente sin conocimiento en administracion',
            'objetivo' => 'Aprender lo basico de aministracion',
            'contenido' => 'Bases de administracion',
            'sintesis' => 'Se aprendera lo basico de administracion',
            'metodologia' => 'online',
            'acreditacion' => 'Diploma de la FI',
            'evaluacion' => 'Examen',
            'bibliografia' => 'El libro administratico',
            'fecha_disenio' => '2018-05-18',
            'clave_curso' => 'FJHCZB'
        ]);
        DB::table('catalogo_cursos')->insert([
            'nombre_curso' =>'Ecuaciones Diferenciales',
            'duracion_curso' => '20',
            'coordinacion_id' => 1,
            'tipo' => 'S',
            'institucion' => 'DGAPA',
            'presentacion' => 'Presentacion',
            'dirigido' => 'Ingenieros',
            'objetivo' => 'Aprender sobre ecuaciones diferenciales',
            'contenido' => 'Lo basico de ecuaciones diferenciales',
            'sintesis' => 'Aqui se aprenderan las bases para resolver ecuaciones diferenciales',
            'metodologia' => 'presencial',
            'acreditacion' => 'Diploma de la FI',
            'evaluacion' => 'Examen',
            'bibliografia' => 'Zill',
            'fecha_disenio' => '2018-05-18',
            'clave_curso' => 'ED1HCZ12'

        ]);
        DB::table('catalogo_cursos')->insert([
            'nombre_curso' =>'Cálculo Integral',
            'duracion_curso' => '20',
            'coordinacion_id' => 1,
            'tipo' => 'C',
            'institucion' => 'CD',
            'presentacion' => 'Presentacion',
            'dirigido' => 'Alumnos de ingenieria',
            'objetivo' => 'Aprender a integrar',
            'contenido' => 'Metodos de integracion',
            'sintesis' => 'Se aprendera a integrar mub bien en este curso',
            'metodologia' => 'Presencial',
            'acreditacion' => 'Diploma de la FI',
            'evaluacion' => 'Examen',
            'bibliografia' => 'Libro de Integrales',
            'fecha_disenio' => '2018-05-18',
            'clave_curso' => 'CI2HCZA'

        ]);
        DB::table('catalogo_cursos')->insert([
            'nombre_curso' =>'Álgebra Lineal',
            'duracion_curso' => '20',
            'coordinacion_id' => 1,
            'tipo' => 'C',
            'institucion' => 'CD',
            'presentacion' => 'Presentacion',
            'dirigido' => 'Alumno que ya acabaron Algebra',
            'objetivo' => 'Que la gente aprenda algebra lineal',
            'contenido' => 'Transformaciones lineales y espacios vectoriales',
            'sintesis' => 'Aqui se aprendera algebra vectorial',
            'metodologia' => 'presencial',
            'acreditacion' => 'Diploma de la FI',
            'evaluacion' => 'Examen',
            'bibliografia' => 'Libro de Algebra Lineal',
            'fecha_disenio' => '2018-05-18',
            'clave_curso' => 'ALA3HCZ'

        ]);
        DB::table('catalogo_cursos')->insert([
            'nombre_curso' =>'Álgebra',
            'duracion_curso' => '20',
            'coordinacion_id' => 1,
            'tipo' => 'C',
            'institucion' => 'CD',
            'presentacion' => 'Presentacion',
            'dirigido' => 'Todo el publico',
            'objetivo' => 'Que los que tomen el curso aprendan lo basico de Algebra',
            'contenido' => 'Matrices y polinomios',
            'sintesis' => 'Aquí se aprenderá sobre Álgebra',
            'metodologia' => 'Presencia',
            'acreditacion' => 'Diploma de la FI',
            'evaluacion' => 'Examen',
            'bibliografia' => 'Libro de Álgebra',
            'fecha_disenio' => '2018-05-18',
            'clave_curso' => 'A1A27HCZ'

        ]);
        DB::table('catalogo_cursos')->insert([
            'nombre_curso' =>'Análisis Numérico',
            'duracion_curso' => '20',
            'coordinacion_id' => 1,
            'tipo' => 'C',
            'institucion' => 'CD',
            'presentacion' => 'Presentacion',
            'dirigido' => 'Alumno que ya cursaron ecuaciones diferenciales',
            'objetivo' => 'Aprender sobre analisis numerico',
            'contenido' => 'Temas de Análisis Numérico',
            'sintesis' => 'Aqui se aprenderan los temas básicos de Ánalisis numérico',
            'metodologia' => 'Online',
            'acreditacion' => 'Diploma de la FI',
            'evaluacion' => 'Examen',
            'bibliografia' => 'Libro de Analisis Numerico',
            'fecha_disenio' => '2018-05-18',
            'clave_curso' => 'AN412HCZ'

        ]);
        DB::table('catalogo_cursos')->insert([
            'nombre_curso' =>'Programación Estructurada',
            'duracion_curso' => '10',
            'coordinacion_id' => 1,
            'tipo' => 'CT',
            'institucion' => 'CD',
            'presentacion' => 'Presentacion',
            'dirigido' => 'Alumnos de la carrera de ingenieria en computación',
            'objetivo' => 'Aprender temas avanzados de programacion ',
            'contenido' => 'Temas Avanzados de programacion',
            'sintesis' => 'En este curso los alumnos seran capaces al finalizar de programar cualquier cosa',
            'metodologia' => 'Online',
            'acreditacion' => 'Diploma de la FI',
            'evaluacion' => 'Examen',
            'bibliografia' => 'Libro de super programación',
            'fecha_disenio' => '2018-05-18',
            'clave_curso' => 'ADFVJ080578451'

        ]);
        DB::table('catalogo_cursos')->insert([
            'nombre_curso' =>'Administración Básica',
            'duracion_curso' => '20',
            'coordinacion_id' => 1,
            'tipo' => 'C',
            'institucion' => 'DGAPA',
            'presentacion' => 'Presentacion',
            'dirigido' => 'Administradores expertos',
            'objetivo' => 'Aprender todo sobre administracion',
            'contenido' => 'Temas avanzados de aministracion',
            'sintesis' => 'En este curso se aprenderan los temas más avanzados de administracion',
            'metodologia' => 'Presencial',
            'acreditacion' => 'Diploma de la FI',
            'evaluacion' => 'Examen',
            'bibliografia' => 'Libro super avanzado de Administracion',
            'fecha_disenio' => '2018-05-18',
            'clave_curso' => 'FJHCZA'
        ]);
        DB::table('cursos')->insert([
            'semestre_anio' => 2020,
            'semestre_pi'=>"2",
            'semestre_si' => "i",
            'fecha_inicio' => '2019-12-04',
            'fecha_fin' => '2020-05-30',
            'hora_inicio' => '14:00',
            'hora_fin' => '16:00',
            'dias_semana' => 'Lunes,Martes',
            'numero_sesiones' => 10,
            'texto_diploma' => 'Texto diploma',
            'costo' => 2000,
            'cupo_maximo' => 5,
            'cupo_minimo' => 5,
            'catalogo_id' => 1,
            'salon_id' => 1
        ]);

        DB::table('cursos')->insert([
            'semestre_anio' => 2016,
            'semestre_pi'=>"2",
            'semestre_si' => "i",
            'fecha_inicio' => '2019-12-04',
            'fecha_fin' => '2019-12-30',
            'hora_inicio' => '14:00',
            'hora_fin' => '16:00',
            'dias_semana' => 'Lunes,Martes',
            'numero_sesiones' => 10,
            'texto_diploma' => 'Texto diploma',
            'costo' => 2000,
            'cupo_maximo' => 20,
            'cupo_minimo' => 5,
            'catalogo_id' => 1,
            'salon_id' => 1
        ]);
        DB::table('cursos')->insert([
            'semestre_anio' => 2018,
            'semestre_pi'=>"2",
            'semestre_si' => "s",
            'fecha_inicio' => '2019-12-03',
            'fecha_fin' => '2020-05-30',
            'hora_inicio' => '14:00',
            'hora_fin' => '16:00',
            'dias_semana' => 'Lunes,Martes',
            'numero_sesiones' => 10,
            'texto_diploma' => 'Texto diploma',
            'costo' => 2000,
            'cupo_maximo' => 20,
            'cupo_minimo' => 5,
            'catalogo_id' => 2,
            'salon_id' => 1
        ]);

        DB::table('cursos')->insert([
            'semestre_anio' => 2016,
            'semestre_pi'=>"2",
            'semestre_si' => "s",
            'fecha_inicio' => '2019-12-04',
            'fecha_fin' => '2018-12-07',
            'hora_inicio' => '14:00',
            'hora_fin' => '16:00',
            'dias_semana' => 'Lunes,Martes',
            'numero_sesiones' => 10,
            'texto_diploma' => 'Texto diploma',
            'costo' => 2000,
            'cupo_maximo' => 20,
            'cupo_minimo' => 5,
            'catalogo_id' => 3,
            'salon_id' => 2
        ]);
        DB::table('cursos')->insert([
            'semestre_anio' => 2017,
            'semestre_pi'=>"2",
            'semestre_si' => "s",
            'fecha_inicio' => '2019-12-20',
            'fecha_fin' => '2018-12-30',
            'hora_inicio' => '14:00',
            'hora_fin' => '16:00',
            'dias_semana' => 'Lunes,Miércoles',
            'numero_sesiones' => 10,
            'texto_diploma' => 'Texto diploma',
            'costo' => 2000,
            'cupo_maximo' => 20,
            'cupo_minimo' => 5,
            'catalogo_id' => 6,
            'salon_id' => 3
        ]);
        DB::table('cursos')->insert([
            'semestre_anio' => 2015,
            'semestre_pi'=>"1",
            'semestre_si' => "s",
            'fecha_inicio' => '2019-12-20',
            'fecha_fin' => '2019-12-30',
            'hora_inicio' => '14:00',
            'hora_fin' => '16:00',
            'dias_semana' => 'Lunes,Miércoles',
            'numero_sesiones' => 10,
            'texto_diploma' => 'Texto diploma',
            'costo' => 2000,
            'cupo_maximo' => 20,
            'cupo_minimo' => 5,
            'catalogo_id' => 7,
            'salon_id' => 3
        ]);
        DB::table('cursos')->insert([
            'semestre_anio' => 2019,
            'semestre_pi'=>"2",
            'semestre_si' => "s",
            'fecha_inicio' => '2018-05-20',
            'fecha_fin' => '2018-05-30',
            'hora_inicio' => '14:00',
            'hora_fin' => '16:00',
            'dias_semana' => 'Lunes,Miércoles',
            'numero_sesiones' => 10,
            'texto_diploma' => 'Texto diploma',
            'costo' => 2000,
            'cupo_maximo' => 20,
            'cupo_minimo' => 5,
            'catalogo_id' => 3,
            'salon_id' => 2
        ]);
        DB::table('cursos')->insert([
            'semestre_anio' => 2019,
            'semestre_pi'=>"2",
            'semestre_si' => "i",
            'fecha_inicio' => '2018-05-20',
            'fecha_fin' => '2018-05-30',
            'hora_inicio' => '14:00',
            'hora_fin' => '16:00',
            'dias_semana' => 'Lunes,Miércoles',
            'numero_sesiones' => 10,
            'texto_diploma' => 'Texto diploma',
            'costo' => 2000,
            'cupo_maximo' => 20,
            'cupo_minimo' => 5,
            'catalogo_id' => 7,
            'salon_id' => 1
        ]);
        DB::table('profesor_curso')->insert([
            'curso_id' => "1",
            'profesor_id' => '1',

        ]);
        DB::table('profesor_curso')->insert([
            'curso_id' => "1",
            'profesor_id' => '2',

        ]);
        DB::table('profesor_curso')->insert([
            'curso_id' => "2",
            'profesor_id' => '3',

        ]);
        DB::table('profesor_curso')->insert([
            'curso_id' => "3",
            'profesor_id' => '4',

        ]);
        DB::table('profesor_curso')->insert([
            'curso_id' => "4",
            'profesor_id' => '5',

        ]);
        DB::table('profesor_curso')->insert([
            'curso_id' => "5",
            'profesor_id' => '6',

        ]);
        DB::table('profesor_curso')->insert([
            'curso_id' => "6",
            'profesor_id' => '7',

        ]);
        DB::table('profesor_curso')->insert([
            'curso_id' => "7",
            'profesor_id' => '1',

        ]);
        DB::table('profesor_curso')->insert([
            'curso_id' => "7",
            'profesor_id' => '2',

        ]);
        DB::table('profesor_curso')->insert([
            'curso_id' => "7",
            'profesor_id' => '3',

        ]);
        DB::table('profesor_curso')->insert([
            'curso_id' => "8",
            'profesor_id' => '2',

        ]);
        DB::table('profesor_curso')->insert([
            'curso_id' => "8",
            'profesor_id' => '4',

        ]);

        DB::table('secretario_apoyo')->insert([
            'secretario' => "Javier Arriaga",
            'comentarios' => 'Licenciado en Administracion, muchos años ha estado en cargos administrativos de la universidad y actualmente se desempeña como secretario.',
            'grado' => "M.E.M.",

        ]);

        DB::table('direccion')->insert([
            'director' => "Gabriel Aguilar Luna",
            'comentarios' => 'Ingeniero en computacion egresado de la UNAM, trabajo mucho tiempo en cargos administraticos en la FI',
            'grado' => "M.E.M."

        ]);

        DB::table('coordinador_general')->insert([
            'coordinador' => "Carolina Herrera",
            'comentarios' => 'Licenciada en derecho, actuelmente se desempeña como coordinadora.',
            'grado' => "M.E.M."

        ]);
    }
}
