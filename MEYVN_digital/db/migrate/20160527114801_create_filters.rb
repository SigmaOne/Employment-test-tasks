class CreateFilters < ActiveRecord::Migration[5.0]
  def change
    create_table :filters do |t|
      t.string :name
      t.string :event_name
      t.references :city, foreign_key: true
      t.references :user, foreign_key: true
      t.date :start_date
      t.date :end_date
    end
  end
end
