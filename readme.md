A utility file, originally designed for CodeIgniter, containing several utility functions for manipulating arrays.

###Functions:

 - `array_pluck()` : grab all of the elements of a given key from an array of arrays
 - `array_print()` : output array in human readable HTML
 - `array_flatten()` : pulls all of the elements of each sub array up a level, repeated recursively for $level times
 - `array_filter_keys() : removes all elements that are in $filter_keys from the array, returns the filtered list
 - `any()` : returns true if any element in the return returns true from the callback. if the callback is not set, will just test the truthiness of each element
 - `all()` : returns true if all elements in the return returns true from the callback. if the callback is not set, will just test the truthiness of each element
 - `array_invoke()` : calls the method on each object in an array, returns an array of the results
 