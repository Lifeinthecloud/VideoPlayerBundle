Getting Started With LITCVideoPlayerBundle
======================================

The Symfony2 component provides a flexible security framework that
allows you to load videos from configuration, a database, or anywhere else
you can imagine. The LITCVideoPlayerBundle builds on top of this to make it quick
and easy to store data for reading videos Youtube, Vimeo or Dailymotion.

So, if you need to persist and fetch the videos's data in your system to
and from a database, then you're in the right place.

## Prerequisites

This version of the bundle requires Symfony 2.1+. If you are using Symfony
2.0.x, please use the 1.0.x releases of the bundle.

### Translations

If you wish to use default texts provided in this bundle, you have to make
sure you have translator enabled in your config.

``` yaml
# app/config/config.yml

framework:
    translator: ~
```

For more information about translations, check [Symfony documentation](http://symfony.com/doc/current/book/translation.html).

## Installation

Installation is a quick (I promise!) 7 step process:

1. Download LITCVideoPlayerBundle using composer
2. Enable the Bundle
3. Create your Video class
4. Configure the LITCVideoPlayerBundle
5. Update your database schema

### Step 1: Download LITCVideoPlayerBundle using composer

Add LITCVideoPlayerBundle by running the command:

``` bash
$ php composer.phar require litc/video-player-bundle "dev-master"
```

Composer will install the bundle to your project's `vendor/litc` directory.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new LITC\VideoPlayerBundle\LITCVideoPlayerBundle(),
    );
}
```

### Step 3: Create your Video class

The goal of this bundle is to persist some `Video` class to a database (MySql,
PostgreSql, ...). Your first job, then, is to create the `Video` class
for your application. This class can look and act however you want: add any
properties or methods you find useful. This is *your* `Video` class.

The bundle provides base classes which are already mapped for most fields
to make it easier to create your entity. Here is how you use it:

1. Extend the base `Video` class (from the ``Model`` folder if you are using
   any of the doctrine variants)
2. Map the `id` field. It must be protected as it is inherited from the parent class.

**Warning:**

> When you extend from the mapped superclass provided by the bundle, don't
> redefine the mapping for the other fields as it is provided by the bundle.

Your `Video` class can live inside any bundle in your application. For example,
if you work at "Acme" company, then you might create a bundle called `AcmeVideoBundle`
and place your `Video` class in it.

In the following sections, you'll see examples of how your `Video` class should
look, depending on how you're storing your videos (Doctrine ORM).

**Note:**

> The doc uses a bundle named `AcmeVideoBundle`. If you want to use the same
> name, you need to register it in your kernel. But you can of course place
> your video class in the bundle you want.

**Warning:**

> If you override the __construct() method in your Video class, be sure
> to call parent::__construct(), as the base Video class depends on
> this to initialize some fields.

#### a) Doctrine ORM Video class

If you're persisting your videos via the Doctrine ORM, then your `Video` class
should live in the `Entity` namespace of your bundle and look like this to
start:

##### Annotations

``` php
<?php
// src/Acme/VideoBundle/Entity/Video.php

namespace Acme\VideoBundle\Entity;

use LITC\VideoPlayerBundle\Model\Video as BaseVideo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="video")
 */
class Video extends BaseVideo
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}
```

**Note:**

> `Video` is a reserved keyword in SQL so you cannot use it as table name.

##### yaml

If you use yml to configure Doctrine you must add two files. The Entity and the orm.yml:

```php
<?php
// src/Acme/VideoBundle/Entity/Video.php

namespace Acme\VideoBundle\Entity;

use LITC\VideoPlayerBundle\Model\Video as BaseVideo;

/**
 * Video
 */
class Video extends BaseVideo
{
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}
```
```yaml
# src/Acme/VideoBundle/Resources/config/doctrine/Video.orm.yml
Acme\VideoBundle\Entity\Video:
    type:  entity
    table: video
    id:
        id:
            type: integer
            generator:
                strategy: AUTO
```


### Step 4: Configure the LITCVideoPlayerBundle

The next step is to configure the bundle to work with the specific needs of
your application.

Add the following configuration to your `config.yml` file according to which type
of datastore you are using.

``` yaml
# app/config/config.yml
litc_video_player:
    db_driver: orm
    video_class: Acme\VideoBundle\Entity\Video
```

### Step 5: Update your database schema

Now that the bundle is configured, the last thing you need to do is update your
database schema because you have added a new entity, the `Video` class which you
created in Step 3.

For ORM run the following command.

``` bash
$ php app/console doctrine:schema:update --force
```
