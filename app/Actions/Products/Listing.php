<?php

namespace App\Actions\Products;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\View\Components\Button;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class Listing
{
    private array $sorts;

    public function __construct(private Request $request)
    {
        $this->sorts = [
            'name' => ['using' => false, 'direction' => 'desc', 'label' => 'Name', 'id' => 0],
        ];
    }

    private function buildQuery()
    {
        $req = Product::query();

        if ($this->request->has('order')) {
            foreach ($this->request->get('order') as $order) {
                switch ($order['column']) {
                    case 0:
                        $this->sorts['name']['using'] = true;
                        $this->sorts['name']['direction'] = $order['dir'];
                        $req->orderBy('name', $order['dir']);
                        break;
                }
            }
        }
        return $req;
    }

    public function get(): array
    {
        $sorting = str('');
        $result['data'] = $this->buildQuery()->get();
        $result['data']->transform(static function (Product $product) {
            $name = Blade::renderComponent((new Button(link: true, label: $product->presenter()->name()))->withAttributes([
                'primary' => true,
                'data-bs-toggle'=>"modal",
                'data-bs-target' => "#update-modal",
                'data-id' => $product->id,
                'data-name' => $product->name
            ]));

            return compact('name');
        });

        $result['data'] = $result['data']->toArray();
        $result['sorting'] = $sorting->toString();
        return $result;
    }
}
