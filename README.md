# **Frame Extractor (Python)**

```
usage: main.py [-h] --binary BINARY_FILE [--full REPORT_FILE] [--short TEST_NAME TEST_EXECUTION_DATE]

optional arguments:
  -h, --help                             show this help message and exit
  --binary BINARY_FILE                   binary file containing frames
  --full REPORT_FILE                     test report file
  --short TEST_NAME TEST_EXECUTION_DATE  name and execution date of the test

examples:
  ./main.py --binary ethernet.bin --full test.rep
  ./main.py --binary ethernet.bin --short test_name "YY-MM-DD hh-mm-ss"

notes:
  [--full] and [--short] can't be used together.
```

```
cd extractor/
pip install -r requirements.txt
python3 main.py
```

# **Web Interface (PHP)**
