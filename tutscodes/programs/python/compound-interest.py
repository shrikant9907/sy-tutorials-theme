# Variables
p = 1000 # Amount
r = 5.0 # Interest
t = 2 # In Year
n = 1 # compounded once

# Calculating simple interest
compoundInterest = p * ( pow( (1 + r /100 * n), (n * t) ) )

# Display result
print("The Compound Interest is: {0}".format(compoundInterest))