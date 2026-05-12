<?php

namespace App\Controllers;

use App\Models\BoletinModel;
use App\Models\ContenidoWebModel;
use App\Models\CursoModel;
use App\Models\DocumentoModel;
use App\Models\NoticiaCategoriaModel;
use App\Models\NoticiaModel;
use App\Models\ProductoModel;
use App\Models\SliderModel;
use App\Models\TestimonioModel;

class Front extends BaseController
{
	protected $session;
	protected $slider;
	protected $producto;
	protected $boletin;
	protected $noticia;
	protected $categorianoticia;
	protected $testimonio;
	protected $documento;
	protected $contenidoWeb;
	protected $curso;
	public function __construct()
	{
		$this->session =  \Config\Services::Session();
		$this->slider = new SliderModel();
		$this->curso = new CursoModel();
	}

	public function inicio()
	{

		$data["seccion"] = "inicio";
		$data["titulo"] = "FINLAND INSTITUTE | Instituto Cultural Nórdico Peruano Finlandés";
		$data["url"] = "";

		$data['sliders'] = $this->slider->buscarPor("orden", "asc", "", "", 428, 0, 0, 0, 0);

		$this->front_views('front/body/inicio', $data);
	}

	public function nosotros()
	{
		$data["seccion"] = "nosotros";

		$this->front_views("front/body/nosotros", $data);
	}
	public function matricula()
	{
		$data["seccion"] = "matricula";

		$this->front_views("front/body/matricula", $data);
	}

	public function curso($url)
	{
		$data["seccion"] = "cursos";

		if ($url) {

			$data['curso'] = $this->curso->obtenerPorUrlAmigable($url);
			$this->front_views("front/body/curso", $data);
		} else {
			return redirect()->to('/');
		}
	}
	public function cursoSueco()
	{
		$data["seccion"] = "cursos";

		$this->front_views("front/body/cursoSueco", $data);
	}

	public function cursoFines()
	{
		$data["seccion"] = "cursos";

		$this->front_views("front/body/cursoFines", $data);
	}

	public function cursoNoruego()
	{
		$data["seccion"] = "cursos";

		$this->front_views("front/body/cursoNoruego", $data);
	}

	public function cursoDanes()
	{
		$data["seccion"] = "cursos";

		$this->front_views("front/body/cursoDanes", $data);
	}

	public function paisesNordicosFinlandia()
	{
		$data["seccion"] = "paises";

		$this->front_views("front/body/paisesNordicosFinlandia", $data);
	}

	public function paisesNordicosSuecia()
	{
		$data["seccion"] = "paises";

		$this->front_views("front/body/paisesNordicosSuecia", $data);
	}

	public function paisesNordicosNoruega()
	{
		$data["seccion"] = "paises";

		$this->front_views("front/body/paisesNordicosNoruega", $data);
	}

	public function paisesNordicosDinamarca()
	{
		$data["seccion"] = "paises";

		$this->front_views("front/body/paisesNordicosDinamarca", $data);
	}

	public function paisesNordicosIslandia()
	{
		$data["seccion"] = "paises";

		$this->front_views("front/body/paisesNordicosIslandia", $data);
	}

	public function galeria()
	{
		$data["seccion"] = "galeria";

		$this->front_views("front/body/galeria", $data);
	}

	public function contacto()
	{
		$data["seccion"] = "contacto";

		$this->front_views("front/body/contacto", $data);
	}



	public function creaCaptcha()
	{
		ob_start();

		$permitted_chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ';

		$image = imagecreatetruecolor(200, 50);

		imageantialias($image, true);

		$colors = [];

		$red = rand(125, 175);
		$green = rand(125, 175);
		$blue = rand(125, 175);

		for ($i = 0; $i < 5; $i++) {
			$colors[] = imagecolorallocate($image, $red - 20 * $i, $green - 20 * $i, $blue - 20 * $i);
		}

		imagefill($image, 0, 0, $colors[0]);

		for ($i = 0; $i < 10; $i++) {
			imagesetthickness($image, rand(2, 10));
			$line_color = $colors[rand(1, 4)];
			imagerectangle($image, rand(-10, 190), rand(-10, 10), rand(-10, 190), rand(40, 60), $line_color);
		}

		$black = imagecolorallocate($image, 0, 0, 0);
		$white = imagecolorallocate($image, 255, 255, 255);
		$textcolors = [$black, $white];

		$fonts = [FCPATH . 'template/fonts/Roboto-Regular.ttf', FCPATH . 'template/fonts/Roboto-Bold.ttf'];

		$string_length = 6;
		$captcha_string = $this->generate_string($permitted_chars, $string_length);



		// $_SESSION['captcha_text'] = $captcha_string;

		$this->session->set('captcha_text', $captcha_string);


		// Llamada a session_write_close() para asegurar que la sesión se guarda
		session_write_close();  // Esto asegura que los cambios en la sesión se guardan antes
		for ($i = 0; $i < $string_length; $i++) {
			$letter_space = (int) floor(170 / $string_length);
			$initial = 15;

			imagettftext($image, 24, rand(-15, 15), $initial + $i * $letter_space, rand(25, 45), $textcolors[rand(0, 1)], $fonts[array_rand($fonts)], $captcha_string[$i]);
		}

		header('Content-type: image/png');
		imagepng($image);
		imagedestroy($image);
		exit;
	}

	function generate_string($input, $strength = 10)
	{
		$input_length = strlen($input);
		$random_string = '';
		for ($i = 0; $i < $strength; $i++) {
			$random_character = $input[mt_rand(0, $input_length - 1)];
			$random_string .= $random_character;
		}

		return $random_string;
	}


	// public function email()
	// {
	// 	$to = 'luisito_619_@hotmail.com';
	// 	$subject = 'Prueba simple';
	// 	$message = 'Hola, prueba desde PHP mail()';
	// 	$headers = "From: portal@finlandinstitute.com";

	// 	if (mail($to, $subject, $message, $headers)) {
	// 		echo 'Correo enviado';
	// 	} else {
	// 		echo 'Error enviando';
	// 	}
	// }
}
