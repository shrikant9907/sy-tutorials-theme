# Swap Any Two Element form the list
def swap_any_two_values(list, p1, p2):
	temp = list[p1]
	list[p1] = list[p2]
	list[p2] = temp
	return list

list = [1,2,3,4,5,6]
print(swap_any_two_values(list, 0, 5))


# Swap Any Two Element form the list
def swap_two_values(list, p1, p2):
	list[p1], list[p2] = list[p2], list[p1]
	return list

list2 = [1,2,3,4,5,6]
print(swap_two_values(list2, 0, 5))


# Swap Any Two Element form the list
def swap_two_values_pop(list, p1, p2):
	val1 = list.pop(p1)
	val2 = list.pop(p2-1)
	list.insert(p1, val2)
	list.insert(p2, val1)
	return list

list3 = [1,2,3,4,5,6]
print(swap_two_values_pop(list3, 0, 5))