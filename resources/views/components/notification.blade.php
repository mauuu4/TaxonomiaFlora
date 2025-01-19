<!-- toast-notification.blade.php -->
@props([
    'type' => 'success',
    'message' => '',
    'id' => 'toast-notification',
    'dismissible' => true
])

@php
    $types = [
        'success' => [
            'icon-bg' => 'text-green-500 bg-green-100 dark:bg-green-800 dark:text-green-200',
            'icon' => '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>',
            'sr-text' => 'Success icon'
        ],
        'error' => [
            'icon-bg' => 'text-red-500 bg-red-100 dark:bg-red-800 dark:text-red-200',
            'icon' => '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>',
            'sr-text' => 'Error icon'
        ],
        'warning' => [
            'icon-bg' => 'text-yellow-500 bg-yellow-100 dark:bg-yellow-800 dark:text-yellow-200',
            'icon' => '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>',
            'sr-text' => 'Warning icon'
        ],
        'info' => [
            'icon-bg' => 'text-blue-500 bg-blue-100 dark:bg-blue-800 dark:text-blue-200',
            'icon' => '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>',
            'sr-text' => 'Info icon'
        ]
    ];
@endphp

<div id="{{ $id }}" 
     class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" 
     role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 {{ $types[$type]['icon-bg'] }} rounded-lg">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            {!! $types[$type]['icon'] !!}
        </svg>
        <span class="sr-only">{{ $types[$type]['sr-text'] }}</span>
    </div>
    <div class="ms-3 text-sm font-normal">{{ $message }}</div>
</div>