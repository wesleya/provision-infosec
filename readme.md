To Do

* add github ssh key so I don't have to keep entering userid and password? not sure how I would do this
* move the ui to provision through queue, update status etc
* create a script that will check for application status and then update in the database, then we can finally show 
    * ip address
    * application status
    * maybe kick the script off when we create. and then have it stop once we get all the info we need, looping every n seconds?
    * php artisan monitor {--provider=} {--token=} {--id}

Provision Script To Do

* setup IP tables
* install SSH key
* run webgoat on supervisord

UI To Do

* kickoff provision script
* save instance data
* show instance data somewhere
* show provider data somewhere

Maintenance To Do

* choose IP address for application access
* script to renew tokens
* refactor to use socialite package for linode
* refactor to sdk for linode

## Notes

`$ php artisan provision:web-goat --api-key={my key}`

## Home UI

No Data

```
Add a provider
```

Partial Data

```
Applications

a message about now we can create an app!

a grid of all possible applications

```

Full Data

```
Applications

app 1 | app 2 | Add New
```
