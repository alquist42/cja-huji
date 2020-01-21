<?php
return [
	'general' => [
		[
			'url' => '/',
			'title' => 'Home'
		],
		[
			'url' => '/art',
			'title' => 'Index of Jewish Art',
			'children' => [
				[
					'url' => '/bezalel-narkiss-index-of-jewish-art',
					'title' => 'The Bezalel Narkiss Index of Jewish Art',
				],
				[
					'url' => '/historic-synagogues-of-europe',
					'title' => 'Historic Synagogues of Europe',
				],
				[
					'url' => '/catalogue-of-wall-paintings',
					'title' => 'A Catalogue of Wall Paintings in Central and East European Synagogues',
				],
				[
					'url' => '/ursula-and-kurt-schubert-archives',
					'title' => 'Ursula and Kurt Schubert Archives',
				],

			]
		],
		[
			'url' => '/activities',
			'title' => 'Activities',
			'disabled' => true
		],
		[
			'url' => '/publications',
			'title' => 'Publications',
			'disabled' => true
		],
		[
			'url' => '/about',
			'title' => 'About',
			'disabled' => true
		],
	]
];