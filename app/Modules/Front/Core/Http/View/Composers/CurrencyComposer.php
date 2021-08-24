<?php

namespace App\Modules\Front\Core\Http\View\Composers;

use Illuminate\View\View;

class CurrencyComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('valuta', (config('app.host') === '1') ? ' грн.' : ' руб.' );
    }
}
