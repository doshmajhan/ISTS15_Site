# create an intial population for our start_resource database

resources=('water' 'electricity' 'gas' 'food' 'luxury')

count=0
add=1
echo "Populating..."
for i in `seq 1 10`;
do
    if [ "$count" -eq 4 ];
    then
        add=-1
    elif [ "$count" -eq 0 ];
    then
        add=1
    fi
    r1=${resources[$count]}
    r2=${resources[$count+$add]}
    count=$(($count + $add))
    echo $r1 $r2
    python code_generator.py -t $r1 -d starting_resources -c $i
    python code_generator.py -t $r2 -d starting_resources -c $i
done
echo "Done"
