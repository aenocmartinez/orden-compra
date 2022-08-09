<?php

namespace Src\infraestructure\repository\eloquent;

use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model {
    protected $table = 'ordenes_de_compra';
    protected $fillable = ['estado'];
    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function items() {
        return $this->belongsToMany(Item::class, 'orden_de_compra_items', 'orden_de_compra_id', 'item_id')
                    ->withPivot(['created_at', 'updated_at'])
                    ->withTimestamps();
    }

    public function agregarItem(Item $item) {
        $this->items()->attach($item);
    }
}