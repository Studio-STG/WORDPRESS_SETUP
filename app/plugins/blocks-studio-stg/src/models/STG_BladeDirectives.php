<?php

namespace STG\models;

class STG_BladeDirectives
{
    private ?STG_Blade $blade = null;

    /**
     * BladeDirectives constructor.
     */
    public function __construct()
    {
        $this->blade = BLADE;

        // Register custom directives
        $this->notEmpty();
    }

    /**
     * Registers a custom notempty directive.
     */
    private function notEmpty(): void
    {
        $this->blade->directive('notempty', function ($expression) {
            return "<?php if (!empty($expression)): ?>";
        });

        $this->blade->directive('endnotempty', function () {
            return "<?php endif; ?>";
        });
    }
}
