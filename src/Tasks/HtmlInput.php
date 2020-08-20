<?php


namespace the42coders\Workflows\Tasks;


use Illuminate\Support\Facades\Blade;
use the42coders\Workflows\Fields\TrixInputField;

class HtmlInput extends Task
{

    static array $fields = [
        'Html' => 'html',
    ];

    static array $output = [
        'HtmlOutput' => 'html_output',
    ];

    public static $icon = '<i class="fas fa-terminal"></i>';

    public function inputFields(): array
    {
        return [
            'html' => TrixInputField::make(),
        ];
    }

    public function execute(): void
    {

        $html = str_replace('&gt;', '>', $this->getData('html'));

        $php = Blade::compileString($html);
        $html = $this->render($php, [
            'model' => $this->model,
            'dataBus' => $this->dataBus,
        ]);

        $this->setData('html_output', $html);

    }

    function render($__php, $__data)
    {
        $obLevel = ob_get_level();
        ob_start();
        extract($__data, EXTR_SKIP);
        try {
            eval('?' . '>' . $__php);
        } catch (Exception $e) {
            while (ob_get_level() > $obLevel) ob_end_clean();
            throw $e;
        } catch (Throwable $e) {
            while (ob_get_level() > $obLevel) ob_end_clean();
            throw new FatalThrowableError($e);
        }
        return ob_get_clean();
    }

}