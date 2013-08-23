This Repository has moved! Please view https://github.com/budkit/platform

Remember to update your git remotes by running the following commands

`$ git remote rm origin`<br />
`$ git remote add --track master origin https://github.com/budkit/platform.git`

The new repository has been split into subrepositories/submodules. So you may need to initialize submodules as follows

1. Delete the **framework** and **vendors** folder
2. Run the following commands

`$ git submodules init`<br />
`$ git submodules update`
