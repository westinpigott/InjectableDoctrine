<?php

namespace WRP\InjectableDoctrine;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use WRP\InjectableDoctrine\DependencyInjection\Compiler\OverRideServiceCompilerPass;

class WRPInjectableDoctrineBundle extends Bundle {

    public function build(ContainerBuilder $container) {
        parent::build($container);
        $container->addCompilerPass(new OverRideServiceCompilerPass(), PassConfig::TYPE_AFTER_REMOVING);
    }

}
