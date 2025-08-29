<?php

namespace App\Observers;

use App\Models\AuditLog;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductObserver
{
    public function created(Product $product): void
    {
        $this->log('created', $product, []);
    }

    public function updated(Product $product): void
    {
        $changes = [
            'before' => $product->getOriginal(),
            'after' => $product->getAttributes(),
        ];
        $this->log('updated', $product, $changes);
    }

    public function deleted(Product $product): void
    {
        $this->log('deleted', $product, ['before' => $product->getOriginal()]);
    }

    protected function log(string $action, Product $product, array $changes): void
    {
        // Skip logging during seeding or when no user is authenticated
        if (app()->runningInConsole() || !Auth::check()) {
            return;
        }

        $adminId = Auth::id();
        AuditLog::create([
            'admin_id' => $adminId,
            'model_changed' => Product::class,
            'action' => $action,
            'changes' => $changes,
            'created_at' => now(),
        ]);
    }
}
