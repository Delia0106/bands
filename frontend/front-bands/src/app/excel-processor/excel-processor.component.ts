import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Component, EventEmitter, Output } from '@angular/core';

@Component({
  selector: 'app-excel-processor',
  templateUrl: './excel-processor.component.html',
  styleUrls: ['./excel-processor.component.scss'],
})
export class ExcelProcessorComponent {
  selectedFile: File | null = null;

  constructor(private http: HttpClient) {}

  public onFileSelected(event: any) {
    this.selectedFile = event.target.files[0] as File;
  }

  public uploadFile() {
    if (this.selectedFile) {
      const formData = new FormData();
      formData.append('file', this.selectedFile);

      const headers = new HttpHeaders();
      headers.append('Content-Type', 'multipart/form-data');

      return this.http
        .post('http://localhost:8000/groupes-musicaux/upload-excel', formData, {
          headers,
        })
        .subscribe(
          (response) => {
            console.log('succes', response);     
          },
          (error) => {
            console.error('err', error);
          }
        );
    } else {
      console.error('No file selected.');
      return null;
    }
  }
}
