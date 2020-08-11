# Test for ogram interview

## Need
Parse input string
```
db.user=root
db.password=
debug=true
passwrod.manager.secret.key=adaD@d3D2D2=
```

Output array
``` php
[
    'db'       => [
        'user'     => 'root',
        'password' => ''
    ],
    'debug'    => true,
    'passwrod' => [
        'manager' => [
            'secret' => [
                'key' => 'adaD@d3D2D2='
            ]
        ]
    ]
];
```