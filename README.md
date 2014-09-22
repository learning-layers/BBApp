LearningToolbox
===============

The current version of the Learning Toolbox works with the Metronic reponsive template version 2.0.2.

You need to copy the following assets from the folder ```metronic_v2.0.2\admin\template\assets``` to the Eclipse project:
   - All files from ```css``` to ```Learning Toolbox\Source Files\assets\css```
   - All files from ```img``` to ```Learning Toolbox\Source Files\assets\img```
   - All files from ```scripts``` to ```Learning Toolbox\Source Files\assets\scripts```

Make sure to set the directories ```Files\assets\css```,  ```Files\assets\img```, and ```Files\assets\scripts``` (including all the copied content) to 'ignore' so that the assets aren't uploaded to the 
GitHub repository. We don't want to have material there that cannot be re-distibuted!

**NOTE**: Do not copy any Metronic files to the folder ```assets_ltb```. That folder is reserved for our own assets.

Usage
---------
Create a new phonegap project.

``` phonegap create LearningToolbox ```
``` phonegap local plugin add https://github.com/phonegap-build/BarcodeScanner.git ```

Then copy the folders ``` www ``` and ``` res ``` inside your project and the following assets from the folder  ```metronic_v2.0.2\admin\template\assets``` inside  ``` www ```:
   - All files from ```css``` to ```Learning Toolbox\www\assets\css```
   - All files from ```img``` to ```Learning Toolbox\www\assets\img```
   - All files from ```scripts``` to ```Learning Toolbox\www\assets\scripts```
