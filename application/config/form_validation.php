<?php
$config = array(
	'product_create' => array(
		array(
			'field' => 'prdName',
			'label' => 'Product Name',
			'rules' => 'required|is_unique[products.prd_name]',
			'errors' => array(
				'required' => 'You must provide a %s.',
				'is_unique' => '%s already exists',
			),
		)
	),
	'prd_category_create' => array(
		array(
			'field' => 'pcaName',
			'label' => 'Category Name',
			'rules' => 'required|is_unique[product_categories.pca_name]',
			'errors' => array(
				'required' => 'You must provide a %s.',
				'is_unique' => '%s already exists',
			),
		)
	),
	'prd_condition_create' => array(
		array(
			'field' => 'pcoName',
			'label' => 'Condition Name',
			'rules' => 'required|is_unique[product_conditions.pco_name]',
			'errors' => array(
				'required' => 'You must provide a %s.',
				'is_unique' => '%s already exists',
			),
		)
	),
	'product_type_create' => array(
		array(
			'field' => 'ptyName',
			'label' => 'Type Name',
			'rules' => 'required|is_unique[product_types.pty_name]',
			'errors' => array(
				'required' => 'You must provide a %s.',
				'is_unique' => '%s already exists',
			),
		)
	)
);