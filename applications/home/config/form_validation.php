<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
                 'log/create' => array(
                                    array(
                                            'field' => 'title',
                                            'label' => 'Title',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'content',
                                            'label' => 'Content',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'tags',
                                            'label' => 'Tags',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'longitude',
                                            'label' => 'Longitude',
                                            'rules' => 'trim|required|numeric|xss_clean'
                                         ),
                                    array(
                                            'field' => 'latitude',
                                            'label' => 'Latitude',
                                            'rules' => 'trim|required|numeric|xss_clean'
                                         )
                                     ),
                 'business/create' => array(
                                    array(
                                            'field' => 'title',
                                            'label' => 'Title',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'email',
                                            'label' => 'Email',
                                            'rules' => 'trim|required|valid_email|xss_clean'
                                         ),
                                    array(
                                            'field' => 'phone',
                                            'label' => 'Phone',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'url',
                                            'label' => 'URL',
                                            'rules' => 'trim|xss_clean'
                                         ),
                                    array(
                                            'field' => 'content',
                                            'label' => 'Content',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'category_id',
                                            'label' => 'Category ID',
                                            'rules' => 'trim|integer|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'longitude',
                                            'label' => 'Longitude',
                                            'rules' => 'trim|required|numeric|xss_clean'
                                         ),
                                    array(
                                            'field' => 'latitude',
                                            'label' => 'Latitude',
                                            'rules' => 'trim|required|numeric|xss_clean'
                                         )
                                     ),
                 'job/create' => array(
                                    array(
                                            'field' => 'title',
                                            'label' => 'Title',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'email',
                                            'label' => 'Email',
                                            'rules' => 'trim|required|valid_email|xss_clean'
                                         ),
                                    array(
                                            'field' => 'phone',
                                            'label' => 'Phone',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'url',
                                            'label' => 'URL',
                                            'rules' => 'trim|xss_clean'
                                         ),
                                    array(
                                            'field' => 'tags',
                                            'label' => 'Tags',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'content',
                                            'label' => 'Content',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'longitude',
                                            'label' => 'Longitude',
                                            'rules' => 'trim|required|numeric|xss_clean'
                                         ),
                                    array(
                                            'field' => 'latitude',
                                            'label' => 'Latitude',
                                            'rules' => 'trim|required|numeric|xss_clean'
                                         )
                                     ),
                 'property/create' => array(
                                    array(
                                            'field' => 'title',
                                            'label' => 'Title',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'email',
                                            'label' => 'Email',
                                            'rules' => 'trim|required|valid_email|xss_clean'
                                         ),
                                    array(
                                            'field' => 'phone',
                                            'label' => 'Phone',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'url',
                                            'label' => 'URL',
                                            'rules' => 'trim|xss_clean'
                                         ),
                                    array(
                                            'field' => 'price',
                                            'label' => 'Price',
                                            'rules' => 'trim|required|numeric|xss_clean'
                                         ),
                                    array(
                                            'field' => 'price_unit',
                                            'label' => 'Price Unit',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'content',
                                            'label' => 'Content',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'longitude',
                                            'label' => 'Longitude',
                                            'rules' => 'trim|required|numeric|xss_clean'
                                         ),
                                    array(
                                            'field' => 'latitude',
                                            'label' => 'Latitude',
                                            'rules' => 'trim|required|numeric|xss_clean'
                                         )
                                     ),
                 'profile/register' => array(
                                    array(
                                            'field' => 'user_id',
                                            'label' => 'User ID',
                                            'rules' => 'trim|required|numeric|xss_clean'
                                         ),
                                    array(
                                            'field' => 'name',
                                            'label' => 'Name',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'mobile',
                                            'label' => 'Mobile Number',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'phone',
                                            'label' => 'Phone',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'birth',
                                            'label' => 'birth',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'twitter_id',
                                            'label' => 'Twitter ID',
                                            'rules' => 'trim|xss_clean'
                                         ),
                                    array(
                                            'field' => 'facebook_id',
                                            'label' => 'Facebook ID',
                                            'rules' => 'trim|xss_clean'
                                         ),
                                    array(
                                            'field' => 'occupation',
                                            'label' => 'Occupation',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'website',
                                            'label' => 'Website',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'introduction',
                                            'label' => 'Introduction',
                                            'rules' => 'trim|required|xss_clean'
                                         )
                                    ),
                 'category/create' => array(
                                    array(
                                            'field' => 'name',
                                            'label' => 'Name',
                                            'rules' => 'trim|required|xss_clean|min_length[5]|max_length[50]'
                                         ),
                                    array(
                                            'field' => 'description',
                                            'label' => 'Description',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'parent_id',
                                            'label' => 'parent ID',
                                            'rules' => 'trim|required|numeric|xss_clean'
                                         )
                                    ),
                 'home/get_markers' => array(
                                    array(
                                            'field' => 'neLat',
                                            'label' => 'North East Latitude',
                                            'rules' => 'trim|required|numeric|xss_clean'
                                         ),
                                    array(
                                            'field' => 'neLng',
                                            'label' => 'North East Longitude',
                                            'rules' => 'trim|required|numeric|xss_clean'
                                         ),
                                    array(
                                            'field' => 'swLat',
                                            'label' => 'South East Latitude',
                                            'rules' => 'trim|required|numeric|xss_clean'
                                         ),
                                    array(
                                            'field' => 'swLng',
                                            'label' => 'South East Longitude',
                                            'rules' => 'trim|required|numeric|xss_clean'
                                         ),
                                    array(
                                            'field' => 'conf_log',
                                            'label' => 'show log markers',
                                            'rules' => 'trim|required|min_length[1]|max_length[1]|xss_clean'
                                         ),
                                    array(
                                            'field' => 'conf_business',
                                            'label' => 'show business markers',
                                            'rules' => 'trim|required|min_length[1]|max_length[1]|xss_clean'
                                         ),
                                    array(
                                            'field' => 'conf_property',
                                            'label' => 'show property markers',
                                            'rules' => 'trim|required|min_length[1]|max_length[1]|xss_clean'
                                         ),
                                    array(
                                            'field' => 'conf_job',
                                            'label' => 'show job markers',
                                            'rules' => 'trim|required|min_length[1]|max_length[1]|xss_clean'
                                         )
                                     )
               );

$id_array = array(array('field' => 'id',
						'label' => 'ID',
						'rules' => 'trim|required|numeric|xss_clean'));

$config['profile/update'] = array_merge($config['profile/register'], $id_array);

$config['log/update'] = array_merge( array_slice($config['log/create'], 0, 3), $id_array);
$config['job/update'] = array_merge( array_slice($config['job/create'], 0, 6), $id_array);
$config['business/update'] = array_merge( array_slice($config['business/create'], 0, 6), $id_array);
$config['property/update'] = array_merge( array_slice($config['property/create'], 0, 7), $id_array);


/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */