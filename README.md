# test_eFashion
This repository is for a test of eFashion

This program is developed by PHP and works in Terminal.

Please open your terminal then clone this repository.

```bash
git clone https://github.com/Tsunehito/test_eFashion.git
```

Hit up  the following command to prepare PHP environment:

```bash
docker-compose up -d
```

After finising downloading, you can open a PHP command line by

```bash
docker-compose exec cli bash
```
Now you can execute the php application with:

```bash
php rovers.php
```

Once the program starts, the interface of terminal will ask you 5 quenstions below then you need to give some informations.

Q1. Size of the plateau?  EX: 5 5

Q2. The position of the rover No.1? EX: 1 2 N

Q3. Give an order to rover No.1 EX LMMLMMLML

Q4. The position of the rover No.2? EX: 3 3 E

Q5. Give an order to rover No.2

Finally, you will have the result of two rovers' positions (x, y and orientation)

Thank you for trying the program.
