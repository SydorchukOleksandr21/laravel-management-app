<div
    class="flex items-center justify-between pb-4 border-b border-border last:border-0 last:pb-0">
    <div class="flex items-center gap-3">
        <div
            class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                 stroke-linejoin="round">
                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                <line x1="1" y1="10" x2="23" y2="10"></line>
            </svg>
        </div>
        <div>
            <p class="font-medium">Payment from #{{ 1000 + $i }}</p>
            <p class="text-sm text-muted-foreground">{{ date('M d, Y', strtotime('-' . $i . ' days')) }}</p>
        </div>
    </div>
    <div class="text-right">
        <p class="font-medium">+${{ rand(50, 500) }}</p>
        <p class="text-sm text-emerald-600">Completed</p>
    </div>
</div>
