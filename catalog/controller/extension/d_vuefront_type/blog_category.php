<?php

use Youshido\GraphQL\Type\Object\ObjectType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\Scalar\IntType;
use Youshido\GraphQL\Type\Scalar\IdType;


class ControllerExtensionDVuefrontTypeBlogCategory extends Controller
{
    private $codename = "d_vuefront";

    public function query()
    {
        $this->load->model('extension/module/' . $this->codename);

        return array(
            'categoryBlog'       => array(
                'type'    => $this->categoryType(),
                'args'    => array(
                    'id' => array(
                        'type' => new IntType()
                    )
                ),
                'resolve' => function ( $store, $args ) {
                    return $this->load->controller( 'extension/'.$this->codename.'/blog_category/category', $args );
                }
            ),
            'categoriesBlogList' => array(
                'type'    => $this->model_extension_module_d_vuefront->getPagination($this->categoryType()),
                'args'    => array(
                    'page'   => array(
                        'type'         => new IntType(),
                        'defaultValue' => 1
                    ),
                    'size'   => array(
                        'type'         => new IntType(),
                        'defaultValue' => 10
                    ),
                    'filter' => array(
                        'type'         => new StringType(),
                        'defaultValue' => ''
                    ),
                    'parent' => array(
                        'type'         => new IntType(),
                        'defaultValue' => 0
                    ),
                    'sort'   => array(
                        'type'         => new StringType(),
                        'defaultValue' => "sort_order"
                    ),
                    'order'  => array(
                        'type'         => new StringType(),
                        'defaultValue' => 'ASC'
                    )
                ),
                'resolve' => function ( $store, $args ) {
                    return $this->load->controller( 'extension/'.$this->codename.'/blog_category/categoryList', $args );
                }
            )
        );
    }

    private function categoryType() {
        return new ObjectType( array(
            'name'        => 'categoryBlog',
            'description' => 'Blog Category',
            'fields'      => array(
                'id'          => new IdType(),
                'name'        => new StringType(),
                'description' => new StringType(),
                'parent_id'   => new StringType()

            )
        ) );
    }
}