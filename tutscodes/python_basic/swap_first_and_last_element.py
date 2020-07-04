# Swap First and Last Number
def swap_two_values(list):
	size = len(list)
	temp = list[0]
	list[0] = list[size-1]
	list[size-1] = temp
	return list

list = [5,8,4,6,2,5,7,9]
# print(list)
newlist = swap_two_values(list)
print(newlist)