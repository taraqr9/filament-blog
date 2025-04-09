<?php

return [
    'subscriber' => [
        'success' => [
            'type' => 'success',
            'title' => 'Successfully Subscribed!',
            'message' => 'You have been added to our newsletter.',
        ],
    ],

    'unsubscribe' => [
        'success' => [
            'type' => 'success',
            'title' => 'You have been successfully unsubscribed.',
            'message' => 'Removed from our newsletter.',
        ],
        'not-found' => [
            'type' => 'error',
            'title' => 'User not subscribed.',
            'message' => 'No subscription found with that email address.',
        ],
    ],

    'error' => [
        'type' => 'error',
        'title' => 'Something Went Wrong!',
        'message' => 'An unexpected error occurred. Please try again later.',
    ],

    'content' => [
        'updated' => [
            'type' => 'success',
            'title' => 'Successfully Updated!',
            'message' => 'You have been updated to our newsletter.',
        ],
    ],
];
