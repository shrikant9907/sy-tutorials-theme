# Numbers
number1 = 100
number2 = 150
number3 = 800

# Check the largest number
if number1 > number2: # false
    if number1 > number3:
        largestNumber = number1
    else:
        largestNumber = number3
else:
    if number2 > number3:
        largestNumber = number2
    else:
        largestNumber = number3

# Display the result
print('The largest number is '+ str(largestNumber))