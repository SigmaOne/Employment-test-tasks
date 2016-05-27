class CreateFilters < ActiveRecord::Migration[5.0]
  def change
    create_table :filters do |t|
      t.string :name
      t.references :city, foreign_key: true
      t.date :start_date
      t.date :end_date
    end

    add_reference :users, :filter, index: true, foreign_key: true
  end
end
