# octobercms-api-sample
A sample using ocotober cms

## Setup records

### 1. Quick start install

```
curl -s https://octobercms.com/api/installer | php
```

### 2. Composer install

```
composer create-project october/october myoctober
```

open the file config/cms.php and enable the disableCoreUpdates setting.

```
'disableCoreUpdates' => true,
```

### 3. Install command

```
php artisan october:install
```

```
INSTALLATION

 Database type:
  [0] MySQL
  [1] Postgres
  [2] SQLite
  [3] SQL Server
 > 0

 MySQL Host [127.0.0.1]:
 > 127.0.0.1

 MySQL Port []:
 > 3306

 Database Name [database]:
 > octobercms_api_sample

 MySQL Login [root]:
 > root

 MySQL Password []:
 > password

Enter a new value, or press ENTER for the default

 First Name [Admin]:
 > Admin

 Last Name [Person]:
 > Person

 Email Address [admin@domain.tld]:
 > woohoeon@gmail.com

 Admin Login [admin]:
 > admin

 Admin Password [admin]:
 > password

 Is the information correct? (yes/no) [yes]:
 > yes

 Application URL [http://localhost]:
 > http://octobercmsapisample.dev

 Configure advanced options? (yes/no) [no]:
 > yes

Enter a new value of 32 characters, or press ENTER to use the generated key

 Application key [mzgHhdRIbASwdE9F530nOBx10A3kMZ2N]:
 > mzgHhdRIbASwdE9F530nOBx10A3kMZ2N

Application key [] set successfully.

 Backend URL [backend]:
 > backend

 File Permission Mask [777]:
 > 777

 Folder Permission Mask [777]:
 > 777

 Enable Debug Mode? (yes/no) [yes]:
 > yes

Migrating application and plugins...

========= INSTALLATION COMPLETE ==========

```

### 4. System update

```
php artisan october:update
```

### 5. Database migration

```
php artisan october:up
```

### 6. Install plugin

```
php artisan create:plugin Api.Test
```

### 7. Create model

```
php artisan create:model Api.Test Apply
```

### 8. Create component

```
php artisan create:component Api.Test Entry
```

### 9. Update Plugin.php

update the file plugins/api/test/Plugin.php

```php
/**
 * Registers any front-end components implemented in this plugin.
 *
 * @return array
 */
 public function registerComponents()
 {
     return [
         'Api\Test\Components\Entry' => 'entry',
     ];
 }
```

### 10. Update home.htm

update the file themes/demo/pages/home.htm

```html
title = "Demonstration"
url = "/"
layout = "default"
is_hidden = 0

[entry]
==
<div class="jumbotron title-js">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h1>Sample</h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    {% component 'entry' %}
</div>
```

### 11. Create Schema

update the file plugins/api/test/updates/create_applies_table.php

```php
public function up()
{
    Schema::create('api_test_applies', function(Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->increments('id');

        $table->string('test_title'); // add
        $table->string('test_contents')->nullable(); // add

        $table->timestamps();
    });
}
```

### 12. Update version.yaml

update the file plugins/api/test/updates/version.yaml

```
1.0.1: First version of Test
1.0.2:
  - Create the entries table
  - create_applies_table.php
```

### 13. Refresh plugin

```
php artisan plugin:refresh Api.Test
```

### 14. Update Entry.php

update the file plugins/api/test/components/Entry.php

```php
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

```

### 15. Update default.htm

update the file plugins/api/test/components/entry/default.htm

```html
<form 
    data-request="{{ __SELF__ }}::onAddItem" 
    data-request-redirect="/" 
>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">create by : <strong>{{ __SELF__.name }}</strong></h3>
        </div>
        <div class="panel-body">
            <div class="input-group">
                <p class="question">title</p>
                <input type="text" name="test_title" class="form-control"/>
                <p class="question">contents</p>
                <div class="textarea">
                    <textarea name="test_contents" class="form-control" cols="100" rows="3"></textarea>
                </div>
                <div class="input-group">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">add</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</form>
```

