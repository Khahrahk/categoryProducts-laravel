<?php

namespace App\Actions\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;

class Listing
{
    private array $sorts;

    public function __construct(private Request $request)
    {
        $this->sorts = [
            'name' => ['using' => false, 'direction' => 'desc', 'label' => 'Name', 'id' => 0],
            'description' => ['using' => false, 'direction' => 'desc', 'label' => 'Description', 'id' => 1],
            'price' => ['using' => false, 'direction' => 'desc', 'label' => 'Price', 'id' => 2],
        ];
    }

    private function buildQuery()
    {
        $req = Product::query();
        $page = ($this->request->input('start') + $this->request->input('length')) / $this->request->input('length');
        if ($this->request->has('filter')) {
            foreach ($this->request->get('filter') as $key => $value) {
                if (!$value || trim($value) === '') {
                    continue;
                }
                switch ($key) {
                    case 'name':
                        $req->where(fn($query) => $query
                            ->where('name', 'LIKE', "%$value%")
                        );
                        break;
                    case 'priceFrom':
                        $req->where(fn($query) => $query
                            ->where('price', '>=', "$value")
                        );
                        break;
                    case 'priceTo':
                        $req->where(fn($query) => $query
                            ->where('price', '<=', "$value")
                        );
                        break;
                }
            }
        }

        if ($this->request->has('order')) {
            foreach ($this->request->get('order') as $order) {
                switch ($order['column']) {
                    case 0:
                        $this->sorts['name']['using'] = true;
                        $this->sorts['name']['direction'] = $order['dir'];
                        $req->orderBy('name', $order['dir']);
                        break;
                    case 1:
                        $this->sorts['description']['using'] = true;
                        $this->sorts['description']['direction'] = $order['dir'];
                        $req->orderBy('description', $order['dir']);
                        break;
                    case 2:
                        $this->sorts['price']['using'] = true;
                        $this->sorts['price']['direction'] = $order['dir'];
                        $req->orderBy('price', $order['dir']);
                        break;
                }
            }
        }

        return $req->paginate($this->request->input('length'), ['*'], 'page', $page);
    }

    public function get(): array
    {
        $result = $this->buildQuery();
        $result->transform(static function (Product $product) {
            $name = Blade::render('<x-button link href="{{ $url }}">{{ $name }}</x-button>', ['url' => route('products.show', $product->id), 'name' => $product->presenter()->name()]);
            $description = $product->description;
            $price = $product->price;
            $category = $product->category_id;
            $edit = Auth::user()->is_admin === 1 ? Blade::render('<a class="pe-auto" data-bs-toggle="modal" data-bs-target="#update-modal" data-id="{{ $id }}" data-name="{{ $name }}" data-description="{{ $description }}" data-price="{{ $price }}" data-category-id="{{ $category }}"><i class="bx bx-edit icon fs-3"></i></a>', ['id' => $product->id, 'name' => $product->name, 'description' => $description, 'price' => $price, 'category' => $category]) : '';
            return compact('name', 'description', 'price', 'category', 'edit');
        });

        $result = $result->toArray();
        $result['recordsTotal'] = $result['total'];
        $result['recordsFiltered'] = $result['total'];
        return $result;
    }
}
