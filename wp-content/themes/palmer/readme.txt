Steps for Yarn:
1. Make  sure you have Yarn installed on your system (https://classic.yarnpkg.com/en/docs/install/)
2. run command: "cd <directory path for theme>"
3. run command: "yarn install" to install yarn
4. run command: "yarn watch" to generate css & js to the "dist" folder


fwstheme:
 - src
    - scss
    - fonts
    - images
    - js
 - dist (don't put anything in this folder it's updated automatically by "yarn watch") [When you run "yarn watch" all will be moved to the "dist" folder]
 - components (Put all the components in this folder)
