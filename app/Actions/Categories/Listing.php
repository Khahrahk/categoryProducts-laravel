<?php

namespace App\Actions\Categories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\{Category};
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
        ];
    }

    private function buildQuery(): LengthAwarePaginator
    {
        $presenter = (new Category())->presenter();
        $page = ($this->request->input('start') + $this->request->input('length')) / $this->request->input('length');
        $req = $presenter->searchQuery($this->request->input('search.value'));

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

        return $req->paginate($this->request->input('length'), '', $page);
    }

    public function get(): array
    {
        $sorting = str('');
        $result = $this->buildQuery();
        $result->getCollection()->transform(static function (Category $category) {
            $name = Blade::render('<x-button link href="{{ $url }}">{{ $name }}</x-button>', ['url' => route('categories.show', $category->id), 'name' => $category->presenter()->name()]);
            $edit = Auth::user()->is_admin === 1 ? Blade::render('<a href="#" class="pe-auto" data-bs-toggle="modal" data-bs-target="#update-modal" data-id="{{ $id }}" data-name="{{ $name }}"><i class="bx bx-edit icon fs-3"></i></a>', ['id' => $category->id, 'name' => $category->name]) : '';
            return compact('name', 'edit');
        });

        $result = $result->toArray();
        $result['recordsTotal'] = $result['total'];
        $result['recordsFiltered'] = $result['total'];
        $result['sorting'] = $sorting->toString();
        return $result;
    }
}
