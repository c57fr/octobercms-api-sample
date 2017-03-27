<?php namespace Api\Test\Components;

use Cms\Classes\ComponentBase;
use Api\Test\Models\Apply;


class Entry extends ComponentBase
{
    /**
    *   This is a person's name.
    *   @var string
    */
    public $name;

    public function componentDetails()
    {
        return [
            'name'        => 'Entry Component',
            'description' => 'A datebase driven apply'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function init()
    {
        // This will execute when the component is
        // first initialized, including AJAX events.
    }

    public function onRun()
    {
        $this->name = 'hoeon woo';
    }

    public function onAddItem()
    {
        $apply = new Apply;
        $apply->test_title = post( 'test_title' );
        $apply->test_contents = post( 'test_contents' );
        $apply->save();
    }

}
