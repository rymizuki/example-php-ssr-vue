<?php

class VueRendererResolver
{
    private $content;
    private $error;

    public function resolve($content)
    {
        $this->content = $content;
    }

    public function reject($error)
    {
        $this->error = $error;
    }

    public function getContent() {
        return $this->content;
    }
}

class VueRenderer
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
        $this->vueSource = file_get_contents($this->nodePath . 'vue/dist/vue.js');
        $this->rendererSource = file_get_contents($this->nodePath . 'vue-server-renderer/basic.js');
        $this->v8 = new V8Js();
    }

    /**
     * @param string $entrypoint
     */
    public function render(string $entrypoint, array $data)
    {
        $this->v8->resolver = new VueRendererResolver();

        $state = json_encode($data);
        $vm = file_get_contents($entrypoint);
        $app = <<<"EOT"
this.global.__PRELOAD_STATE__ = ${state};
${vm}
renderVueComponentToString(vm, (err, res) => {
    if (err) {
        PHP.resolver.__call("reject", [err]);
        return;
    }
    PHP.resolver.__call("resolve", [res]);
})
EOT;
        $this->execute($app);
        $html = $this->v8->resolver->getContent();
        $this->v8->resolver = null;
        return $html;
    }

    private function execute($appCode) {
        $this->v8->executeString($this->generateGlobalCode());
        $this->v8->executeString($this->vueSource);
        $this->v8->executeString($this->rendererSource);
        $this->v8->executeString($appCode);
    }

    private function generateGlobalCode()
    {
        return <<<'EOT'
var process = {
    env: {
        VUE_ENV: "server",
        NODE_ENV: "production"
    }
};
this.global = { process: process };
EOT;
    }
}

$renderer = new VueRenderer('node_modules/');
$html = $renderer->render('./app.js', [
    'message' => 'hello vue!'
]);

echo $html;