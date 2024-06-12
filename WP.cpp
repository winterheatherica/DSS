#include <iostream>
#include <cmath>

using namespace std;

int kriteria, alternatif;

double arr1[100];
string arr2[100];
double arr3[100][100];

double arr4[100];
double arr5[100];

double arrakhir[100];

int main(){

    cin >> kriteria;

    for (int i = 0; i < kriteria; i++){
        cin >> arr1[i] >> arr2[i];
    }

    cin >> alternatif;

    for (int i = 0; i < alternatif; i++){
        for (int j = 0; j < kriteria; j++){
            cin >> arr3[i][j];
        }
    }

    for (int i = 0; i < kriteria; i++){
        cout << arr1[i] << arr2[i] << endl;
    }

    cout << endl;

    for (int i = 0; i < alternatif; i++){
        for (int j = 0; j < kriteria; j++){
            cout << arr3[i][j] << " ";
        }
        cout << endl;
    }
    cout << endl;

    int total = 0;
    for (int i = 0; i < kriteria; i++){
        total += arr1[i];
    }
    cout << total << endl;

    for (int i = 0; i < kriteria; i++){
        if (arr2[i] == "c"){
            arr4[i] = (arr1[i]*-1)/total;
        } else {
            arr4[i] = arr1[i]/total;
        }
    }

    cout << endl;

    for (int i = 0; i < kriteria; i++){
        cout << arr4[i] << " ";
    }

    cout << endl;

    double kali = 1;
    for (int i = 0; i < alternatif; i++){
        for (int j = 0; j < kriteria; j++){
            kali *= pow(arr3[i][j], arr4[j]);
        }
        arr5[i] = kali;
        kali = 1;
    }

    cout << endl;

    for (int i = 0; i < alternatif; i++){
        cout << arr5[i] << " ";
    }

    cout << endl;

    double totalarr5 = 0;

    for (int i = 0; i < alternatif; i++){
        totalarr5 += arr5[i];
    }

    cout << endl;

    cout << totalarr5 << endl;

    for (int i = 0; i < alternatif; i++){
        arrakhir[i] = arr5[i]/totalarr5;
    }

    cout << endl;

    for (int i = 0; i < alternatif; i++){
        cout << arrakhir[i] << " ";
    }

}