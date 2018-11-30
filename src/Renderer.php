<?php
namespace VueSSR;

use V8Js;

class Renderer 
{

    private $nodePath;
    private $vueSource;
    private $rendererSource;
    private $v8;

    /**
     * @param string $nodeModulesPath
     * @return void
     */
    public function __construct (string $nodeModulesPath)
    {
        $this->nodePath = $nodeModulesPath;
        $this->v8 = new V8Js();
    }

    /**
     * @param string $entrypoint
     */
    public function render(string $entrypoint, array $data)
    {
        $state = json_encode($data);
        $app = file_get_contents($entrypoint);

        $this->setupVueRendderer();
        $this->v8->executeString("this.global.__PRELOAD_STATE__ = ${state}");
        $this->v8->executeString($app);
    }

    private function setupVueRendderer()
    {
        $prepareCode = <<<'EOT'
var process = {
    env: {
        VUE_ENV: "server",
        NODE_ENV: "production"
    }
};
this.global = { process: process };
EOT;
        $vueSource = file_get_contents($this->nodePath . 'vue/dist/vue.js');
        $rendererSource = file_get_contents($this->nodePath . 'vue-server-renderer/basic.js');

        $this->v8->executeString($prepareCode);
        $this->v8->executeString($vueSource);
        $this->v8->executeString($rendererSource);
    }
}

