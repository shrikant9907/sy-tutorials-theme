# Number
number = 7
factorial = 1
n = 1

# Using while loop
while n <= number:
    factorial = factorial*n
    n = n + 1

# Display result
print("The Factorial of {0} is {1}".format(number, factorial))