import { Seccion6Page } from './app.po';

describe('seccion6 App', function() {
  let page: Seccion6Page;

  beforeEach(() => {
    page = new Seccion6Page();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});
