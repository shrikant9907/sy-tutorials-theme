# Numbers
number1 = 20
number2 = 50
number3 = 30

# Check the largest number
if number1 > number2 and number1 > number3:
    largestNumber = number1
elif number2 > number3: # true
    largestNumber = number2
else:
    largestNumber = number3

# Display the result
print('The largest number is '+ str(largestNumber))