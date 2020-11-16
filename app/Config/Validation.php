<?php namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
		\Config\Reglas\DateRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $registro_usuario = [
        'PNombre' => [
					  'rules' => 'required|alpha',
					  'errors' => [
									  'required' => 'Primer nombre es un campo obligatorio',
									  'alpha' => 'Primer nombre solo debe contener letras'
								  ]
					 ],
		'SNombre' => [
						'rules' => 'permit_empty|alpha',
						'errors' => [
										'alpha' => 'Segundo nombre solo debe contener letras'
									]
					 ],
		'PApellido' => [
						'rules' => 'required|alpha',
						'errors' => [
										'required' => 'Primer apellido es un campo obligatorio',
										'alpha' => 'Primer apellido solo debe contener letras'
									]
					   ],

		'SApellido' => [
						'rules' => 'permit_empty|alpha',
						'errors' => [
										'alpha' => 'Segundo apellido solo debe contener letras'
									]
						],
		'FechaNacimiento' => [
								'rules' => 'required|valid_date|fecha_nacimiento|edad_minima',
								'errors' => [
												'required' => 'Fecha de Nacimiento es un campo obligatorio',
												'valid_date' => 'Fecha de Nacimiento no tiene el formato correcto',
												'fecha_nacimiento' => 'Fecha de Nacimiento no puede ser mayor al día de hoy',
												'edad_minima' => 'No cumple con el requisito mínimo de edad'
											]
							   ],
		'Nick' => [
					'rules' => 'required|regex_match[^[A-Za-z._-]+([A-Za-z0-9]*|[._-]?[A-Za-z0-9]+)*$]|is_unique[usuario.usunick]',
					'errors' => [
									'required' => 'Nick es un campo obligatorio',
									'regex_match' => 'Nick tiene un formato incorrecto',
									'is_unique' => 'Nick ingresado no disponible'
								]
				   ],
		'Clave' => [
					'rules' => 'required',
					'errors' => [
									'required' => 'La contraseña es un campo obligatorio'
								]
				    ],
		'ClaveConfirmar' => [
							'rules' => 'required|matches[Clave]',
							'errors' => [
											'required' => 'Confirmación de contraseña obligatoria',
											'matches' => 'Las contraseñas no coinciden'
										]
							],
		'Sexo' => [
					'rules' => 'required',
					'errors' => [
									'required' => 'Sexo es un campo obligatorio'
								]
				   ],
        'Email' => [
					'rules' => 'required|valid_email',
					'errors' => [
									'required' => 'Correo electrónico es un campo obligatorio',
									'valid_email' => 'El correo electrónico no tiene el formato correcto'
								]
					],
		'Foto' => [
					'rules' => 'uploaded[Foto]|is_image[Foto]',
					'errors' => [
									'uploaded' => 'Foto no ha sido seleccionada.',
									'is_image' => 'Foto inválida, asegurese que la extensión sea la correcta para una imagen'
								]
				  ]
    ];

}
