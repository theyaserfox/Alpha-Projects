using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;
using HmiLike.Pages;

using System.Drawing;

namespace HmiLike
{

    /// <summary>
    /// Logica di interazione per MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {
        public MainWindow()
        {
            InitializeComponent();
            this.MouseDown += new System.Windows.Input.MouseButtonEventHandler(Start_MouseDown);
            Switcher.pageSwitcher = this;
            Switcher.Switch(new Page1());
            this.Cursor = Cursors.None;
           
        }
        private void Start_MouseDown(object sender, System.Windows.Input.MouseButtonEventArgs e)
        {
            DragMove();
        }
        public void Navigate(UserControl nextPage)
        {
            this.Content = nextPage;
        }

        private void Button_Click_2(object sender, RoutedEventArgs e)
        {
            
        }     
    }
}
