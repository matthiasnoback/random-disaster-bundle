# ProjectBundle a.k.a. RandomDisasterBundle

By Matthias Noback

This bundle will start throwing random exceptions from the day you start
your project, to the day of the project's deadline. So even though you are
an excellent programmer, and you have already completed all your work,
the manager who tests the application will get the impression that you are
still fixing many bugs and what not. But the number of exceptions will steadily
decrease when the deadline gets closer, until it reaches zero. Then the
manager will be very happy with you, given the vast amount of work you have
done.

Please note: this bundle is named ``ProjectBundle`` to prevent suspicious
looking stack traces from spoiling the fun.

## Installation

Using Composer, add to ``composer.json``:

    {
        "require": {
            "matthiasnoback/random-disaster-bundle": "dev-master"
        }
    }

Then using the Composer binary:

    php composer.phar update matthiasnoback/random-disaster-bundle

Register the bundle in ``/app/AppKernel.php``:

    <?php

    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                // ...
                new Matthias\ProjectBundle\MatthiasProjectBundle()
            );
        }
    }

## Configuration

The bundle has two configuration options: the start date of the project
(on which every request will throw an exception), and the deadline of the
project, when random exceptions will not occur anymore (given you are
an otherwise outstanding programmer). Both dates should be acceptable by
PHP's ``strtotime()`` function.

    # in config.yml
    matthias_project:
        start_at: "2013-04-01"
        deadline: "2013-04-16"
