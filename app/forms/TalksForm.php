<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * PHP version 5.4
 *
 * @category   CategoryName
 * @package    PackageName
 * @author     Matthew Setter <matthew@maltblue.com>
 * @copyright  2014 Client/Author
 * @see        Enter if required
 * @since      File available since Release/Tag:
 */

use Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\Hidden,
    Phalcon\Forms\Element\Select;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class TalksForm extends Form
{
    public function getCsrf()
    {
        return $this->security->getToken();
    }

    public function beforeValidation()
    {

    }

    public function afterValidation()
    {

    }

    public function initialize($talk, $options = array())
    {
        // Set the same form as entity
        $this->setEntity($talk);

        if (!empty($options)) {
            if ($options['edit']) {
                $this->add(new Hidden('id'));
            }
        }

        if (!$this->has('id')) {
            $this->add(new Text('id', array(
                'placeholder' => "Add a talk id",
                'class' => 'form-control'
            )));
        }

        $this->add(new Text("name", array(
            'maxlength' => 30,
            'placeholder' => "What's the talk called?",
            'class' => 'form-control'
        )));

        $this->add(new Text("starts", array(
            'maxlength' => 15,
            'placeholder' => 'When does the talk start',
            'class' => 'form-control'
        )));

        $this->add(new Text("finishes", array(
            'maxlength' => 15,
            'placeholder' => 'When does the talk finish',
            'class' => 'form-control'
        )));

        $this->add(new Select("status", array(
            'a' => 'Active',
            'i' => 'Inactive'
        ), array(
            'class' => 'form-control'
        )));


        // Add a text element to put a hidden csrf
        $this->add(new Hidden("csrf"));

        $this->setupValidation();
    }

    public function setupValidation()
    {
        $this->get('name')->addValidator(
            new PresenceOf(array(
                'message' => 'Name is required'
            ))
        )->addValidator(
                new StringLength(array(
                    'min' => 10,
                    'messageMinimum' => 'The name is too short'
                ))
            )
            ->setFilters(array('trim', 'string'));

        $this->get('starts')->addValidator(
            new PresenceOf(array(
                'message' => 'Start is required'
            ))
        )
            ->setFilters(array('trim'));

        $this->get('finishes')->addValidator(
            new PresenceOf(array(
                'message' => 'Finish is required'
            ))
        )->addValidator(
                new StringLength(array(
                    'min' => 10,
                    'messageMinimum' => 'The name is too short'
                ))
            )
            ->setFilters(array('trim'));
    }
}